<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
            'password' => 'required | min: 3',
            'phone' => 'required',
            'avatar' => 'required | image | mimes:jpeg,png,jpg,gif | max:2048',
            'address' => 'required',
            'id_country' => 'required',
            'level' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute: Không được để trống',
            'max' => ': Không được quá: max ký tự',
            'min' => ':attribute: Phải có ít nhất: min ký tự',
            'mimes' => ':attribute: Hình ảnh phải có định dạng jpeg,png hoặc jpg',
            'avatar.max' => '.attribute: Hình ảnh phải có dung lượng < 1mb'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'address' => 'Address',
            'phone' => 'Telephone',
            'id_country' => 'Nationality'

        ];
    }
}
