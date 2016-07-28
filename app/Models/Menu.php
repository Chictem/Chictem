<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return owner of this menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Menu json to array.
     *
     * @param $content
     * @return mixed
     */
    public function getContentAttribute($content)
    {
        if (is_json($content)) {
            return json_decode($content);
        }
        return $content;
    }


}
