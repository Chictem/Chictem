<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    /**
     * Get model attributes.
     * Default except is listed in $except.
     * You can add extra attributes to $extra to except them.
     *
     * @param array $extra
     * @param array $except
     * @return array
     */
    public function attrs($extra = [], $except = ['id', 'created_at', 'updated_at'])
    {
        $attributes = array_excepts(array_keys($this->getAttributes()), array_merge($except, $extra));
        return $attributes;
    }


}
