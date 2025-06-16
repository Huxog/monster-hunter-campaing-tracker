<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class CampaignUpdate extends FormRequest
{
    use FormatValidationFailure;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'team' => 'required|string',
            'mapId' => 'sometimes|numeric|exists:maps,id,deleted_at,NULL'
        ];
    }

    /**
     * Get the error messages fo the validation rules
     * 3 char entity
     * 2 digit stack level
     *      middleware -> 01
     *      controller -> 02
     *      service    -> 03
     *      model      -> 04
     *      other      -> 05
     * 2 digit resource route type
     *      index      -> 01
     *      store      -> 02
     *      show       -> 03
     *      update     -> 04
     *      delete     -> 05
     *      custom     -> 06
     * 4 digit sequence map
     * @return array<string, string>
     * @throws conditon
     **/
    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name for the campaign',
            'name.string' => 'The name must be a string',
            'team.required' => 'Please name your team for this campaign',
            'team.string' => 'The team name must be a string',
            'mapId.numeric' => 'Must be a valid map identifier',
            'mapId.exists' => 'No valid map found'
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'CAM-0204-0001',
            'name.string' => 'CAM-0204-0002',
            'team.required' => 'CAM-0204-0003',
            'team.string' => 'CAM-0204-0004',
            'mapId.numeric' => 'CAM-0204-0005',
            'mapId.exists' => 'CAM-0204-0006',
        ];
    }

    /**
     * Provide descriptions and examples for the request body parameters.
     *
     * @return array
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the campaign',
                'example' => 'Super awesome campaign',
            ],
            'team' => [
                'description' => 'The name of the team that will play on the campaign',
                'example' => 'Power rangers',
            ],
            'mapId' => [
                'description' => 'The map in which the campaign will be played',
                'example' => '2',
            ],
        ];
    }

}
