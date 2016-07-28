<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends BaseModel
{
    /**
     * Return owner of this page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get tags this page attaches to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'page_tag', 'page_id', 'tag_id');
    }

}
