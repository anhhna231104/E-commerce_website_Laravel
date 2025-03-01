<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title' => 'required | max: 200',
            'image' => 'required |  image | mimes:jpeg,png,jpg,gif | max:2048',
            'description' => 'required',
            'content' => 'required '

        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute: Không được để trống',
            'max' => ':attribute: Không được quá: max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Hình ảnh',
            'description' => 'Mô tả',
        ];
    }
}
