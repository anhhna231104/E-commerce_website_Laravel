<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCountryRequest extends FormRequest
{
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
            'name_country' => 'required | max: 200'
        ];
    }

    public function messages()
    {
        return [
            'required' => ': attribute: Không được để trống',
            'max' => ': attribute: Không được quá: max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name_country' => 'Tên quốc gia'
        ];
    }
}
