<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required|numeric',
            'id_category' => 'required',
            'id_brand' => 'required',
            'status' => 'required',
            'sale' => 'nullable|numeric|min:0|max:100',
            'company' => 'required|string|max:255',
            'avatar' => 'required|max:1024', // Max size in KB (1MB = 1024KB)
            'detail' => 'required|string',
            //
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'Vui lòng tải lên ít nhất một hình ảnh',
            // 'avatar.image' => 'Các tập tin phải là một hình ảnh',
            // 'avatar.mimes' => 'Chỉ cho phép các định dạng JPEG, PNG, JPG',
            'avatar.max' => 'Hinhf ảnh phải nhỏ hơn 1MB.',
        ];
    }

    public function attributes()
    {
        return [
            // Custom attribute names for better error messages
            'name' => 'product name',
            'price' => 'product price',
            'id_category' => 'category',
            'id_brand' => 'brand',
            'status' => 'product status',
            'sale' => 'sale percentage',
            'company' => 'company name',
            'avatar.*' => 'product image',
            'detail' => 'product detail',
        ];
    }
}
