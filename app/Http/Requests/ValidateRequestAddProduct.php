<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequestAddProduct extends FormRequest
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
            'name'  => 'bail|required|min:2|max:255',
            'price' => 'required|numeric',
            'product_images' => 'required',
            'category_id' => 'required',
            'product_content' => 'required|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bắt buộc phải nhập tên',
            'name.min' => 'Tối thiểu 2 ký tự',
            'name.max' => 'Tối đa 255 ký tự',
            'product_images.required' => 'Hãy chọn ảnh',
            'price.required'=> 'Bắt buộc phải nhập giá',
            'price.numeric'=> 'Giá phải là số',
            'category_id.required' => 'Bắt buộc phải chọn danh mục sản phẩm',
            'product_content.required'=> 'Bắt buộc phải nhập mô tả',
            'product_content.max'=> 'Mô tả sản phẩm dưới 1000 ký tự',
        ];
    }
}
