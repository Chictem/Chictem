<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Get Attributes Keys.
     *
     * @return array
     */
    public function attrs($except = ['id', 'created_at', 'updated_at']) {
        $attributes = $this->getAttributes();
        $attributes = array_keys($attributes);
        $attributes = array_excepts($attributes, $except);
        return $attributes;
    }



}
