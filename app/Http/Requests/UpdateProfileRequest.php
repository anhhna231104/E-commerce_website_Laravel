<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required | max: 200',
            'email' => 'required',
            'password' => 'nullable | min: 3',
            'phone' => 'nullable',
            'address' => 'nullable',
            'avatar' => 'nullable | image | mimes:jpeg,png,jpg,gif | max:2048',
            'id_country' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute: Không được để trống',
            'max' => ': Không được quá: max ký tự',
            'password.min' => ': Mật khẩu phải có ít nhất: min ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar'

        ];
    }
}
