<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'id_user' => 'required',
            'id_brand' => 'required',
            'id_category' => 'required',
            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
            'detail' => 'required',
            'company_profile' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute: Không được để trống'
        ];
    }

    public function attributes()
    {
        return [
            'cmt' => 'Nội dung comment',
        ];
    }
}
