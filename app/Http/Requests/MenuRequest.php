<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MenuRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|unique:menus',
            'display_name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'content' => 'sometimes|required',
        ];
    }

    /**
     * Get validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique' => ':attribute已经存在,请更换',
        ];
    }

    /**
     * Get validation attributes.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '菜单名称',
            'display_name' => '显示名称',
            'description' => '菜单描述',
            'content' => '菜单内容',
        ];
    }

}
