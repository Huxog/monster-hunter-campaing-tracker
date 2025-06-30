<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class MapStore extends FormRequest
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
            'name' => 'required|string|unique:maps',
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
     *
     * @throws conditon
     **/
    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name for the map',
            'name.string' => 'The name must be a string',
            'name.unique' => 'Name is already taken by another map',
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'MAP-0202-0001',
            'name.string' => 'MAP-0202-0002',
            'name.unique' => 'MAP-0202-0003',
        ];
    }
}
