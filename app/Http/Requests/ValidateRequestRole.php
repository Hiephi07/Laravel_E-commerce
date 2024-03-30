<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ValidateRequestRole extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'  => 'bail|required|min:2|max:255',
            'display_name' => 'required|max:255'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Bắt buộc phải nhập tên',
            'name.min' => 'Tối thiểu 2 ký tự',
            'name.max' => 'Tối đa 255 ký tự',
            'display_name.required' => 'Bắt buộc phải điền tên hiển thị',
            'display_name.max' => 'Tối đa 255 ký tự'
        ];
    }
}
