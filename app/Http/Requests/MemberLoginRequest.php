<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }
    
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'email' => ':attribute không đúng định dạng email',
            'max' => ':attribute không được vượt quá :max ký tự',
            'min' => ':attribute phải chứa ít nhất :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
           
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ];
    }
}
