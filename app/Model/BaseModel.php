<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Get config value.
     *
     * @return mixed
     */
    protected function getConfigValueByKey($key)
    {
        $value = Option::where('key', $key)->first()->value;
        return $value;
    }
}
