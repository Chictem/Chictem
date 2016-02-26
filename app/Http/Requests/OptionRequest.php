<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OptionRequest extends Request
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
            'type' => 'required',
            'key' => 'required',
            'value' => 'required',
            'display_name' => 'required',
        ];
    }

    /**
     * Get validation attributes.
     *
     * @return array
     */
    public function attributes() {
        return [
            'key' => '配置键值',
            'type' => '配置类型',
            'value' => '配置键名',
            'display_name' => '配置名称',
        ];
    }
}
