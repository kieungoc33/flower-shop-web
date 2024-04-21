<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCatalogueRequest extends FormRequest
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
            'user_catalogue_id' => 'gt:0',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập vào ô tiêu dề',
            'user_catalogue_id.gt' => 'Bạn chưa chọn danh mục cha',
        ];
    }
}
