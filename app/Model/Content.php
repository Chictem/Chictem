<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends BaseModel
{
    /**
     * Return owner of this content.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    /**
     * Return category this content belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    /**
     * Get tags this content attaches to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'content_tag', 'content_id', 'tag_id');
    }

}
