<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'id_country' => 'required|integer',
            'avatar' => 'nullable|max:255',
            'password' => 'required|string|min:8',
            //
        ];
    }
    
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'email' => ':attribute không đúng định dạng email',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'integer' => ':attribute phải là số nguyên',
            'min' => ':attribute phải chứa ít nhất :min ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'id_country' => 'Quốc gia',
            'avatar' => 'Ảnh đại diện',
            'password' => 'Mật khẩu',
        ];
    }
}
