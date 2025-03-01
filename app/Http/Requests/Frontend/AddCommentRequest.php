<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
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
            'cmt' => 'required'
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
