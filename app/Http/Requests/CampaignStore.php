<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class CampaignStore extends FormRequest
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'team' => 'required|string',
            'mapId' => 'sometimes|numeric|exists:maps,id,deleted_at,NULL',
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
     *
     * @return array<string, string>
     **/
    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name for the campaign',
            'name.string' => 'The name must be a string',
            'team.required' => 'Please name your team for this campaign',
            'team.string' => 'The team name must be a string',
            'mapId.numeric' => 'Must be a valid map identifier',
            'mapId.exists' => 'No valid map found',
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'CAM-0202-0001',
            'name.string' => 'CAM-0202-0002',
            'team.required' => 'CAM-0202-0003',
            'team.string' => 'CAM-0202-0004',
            'mapId.numeric' => 'CAM-0202-0005',
            'mapId.exists' => 'CAM-0202-0006',
        ];
    }
}
