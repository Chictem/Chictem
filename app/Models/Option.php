<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Unserialize variable to array.
     *
     * @param $education
     * @return string
     */
    public function getValueAttribute($value)
    {
        if (is_serialized($value)) {
            return unserialize($value);
        }
        return $value;
    }

    /**
     * If value is kind of array, Then to sequence.
     *
     * @param $value
     */
    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['value'] = serialize($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    /**
     * Deletable default to 1.
     *
     * @param $deletable
     */
    public function setDeletableAttribute($deletable)
    {
        $deletable = $deletable === 0 ? $deletable : 1;
        $this->attributes['deletable'] = $deletable;
    }

    /**
     * Get option item query.
     *
     * @param $query
     * @param $key
     * @return mixed
     */
    public function scopeItem($query, $key)
    {
        return $query->where('key', $key)->first();
    }

    /**
     * Get kind query.
     *
     * @param $query
     * @param $key
     * @return mixed
     */
    public function scopeType($query, $key)
    {
        return $query->where('type', $key)->get();
    }
}
