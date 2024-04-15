<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'email' => 'required|email|string|unique:users|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|integer|gt:0',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password'
            //
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng. Ví dụ : abc@gmail.com',
            'email.unique' => 'Email đã tồn tại',
            'email.string' => 'Email phải là chuỗi ký tự',
            'email.max' => 'Email không được vượt quá 191 ký tự',
            'name.required' => 'Họ tên không được để trống',
            'name.string' => 'Họ tên phải là chuỗi ký tự',
            'user_catalogue_id.gt' => 'Vui lòng chọn loại người dùng',
            'password.required' => 'Mật khẩu không được để trống',
            're_password.required' => 'Nhập lại mật khẩu không được để trống',
            're_password' => 'Mật khẩu không khớp',
        ];
    }
}
