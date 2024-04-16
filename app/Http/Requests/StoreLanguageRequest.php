<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:languages',
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên ngôn ngữ',
            'canonical.required' => 'Bạn chưa nhập tên viết tắt',
            'canonical.unique' => 'Tên viết tắt đã tồn tại',
        ];
    }
}
