<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCatalogueRequest extends FormRequest
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
            'name' => 'required|string',
           
        ];
    }
    public function messages()
    {
        return [
        
            'name.required' => 'Bạn chưa nhập Nhóm thành viên',
            'name.string' => 'Nhóm thành viên phải là chuỗi ký tự',
        
        ];
    }
}
