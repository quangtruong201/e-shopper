<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjusted validation rule
            'description' => 'required|string',
            'content' => 'required|string',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'avatar.required' => 'Hình ảnh là bắt buộc.',
            'avatar.image' => 'Hình ảnh phải là một hình ảnh.',
            'avatar.mimes' => 'Hình ảnh phải là một tệp của loại: :values.',
            'avatar.max' => 'Hình ảnh không được vượt quá :max kilobytes.',
            'description.string' => 'Miêu tả phải là một chuỗi ký tự.',
            'content.string' => 'Nội dung phải là một chuỗi ký tự.',
        ];
    }
    

    public function attributes()
    {
        return [
            'title' => 'tiêu đề',
            'image' => 'hình ảnh',
            'description' => 'miêu tả',
            'content' => 'nội dung',
        ];
    }

}

