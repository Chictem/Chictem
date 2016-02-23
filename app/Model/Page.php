<?php

namespace App\Model;

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
        return $this->belongsTo('App\Model\User');
    }

    /**
     * Get tags this page attaches to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'page_tag', 'page_id', 'tag_id');
    }

}
