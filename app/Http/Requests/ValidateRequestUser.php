<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ValidateRequestUser extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'  => 'bail|required|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|max:32',
            'roles_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Bắt buộc phải nhập tên',
            'name.min' => 'Tối thiểu 2 ký tự',
            'name.max' => 'Tối đa 255 ký tự',
            'email.required' => 'Hãy chọn ảnh',
            'email.email'=> 'Sai định dạng email',
            'password.required' => 'Bắt buộc phải nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự',
            'password.max' => 'Mật khẩu tối đa 32 kí tự',
            'roles_id.required' => 'Bắt buộc phải chọn vai trò'
        ];
    }
}
