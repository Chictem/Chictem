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
        $attributes = array_excepts(array_keys($attributes), $except);
        return $attributes;
    }



}
