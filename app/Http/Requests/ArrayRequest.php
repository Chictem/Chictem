<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArrayRequest extends Request
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
            'key' => 'required_with:id|unique:options',
            'display_name' => 'required_with:id',
            'value' => 'required_with:id|array',
        ];
    }

    /**
     * Get display_name of attributes.
     *
     * @return array
     */
    public function attributes() {
        return [
            'id' => '数组',
            'key' => '数组键名',
            'display_name' => '数组名称',
            'value' => '数组内容',
        ];
    }
}
