<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UniqueArrayRequest extends ArrayRequest
{

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
}
