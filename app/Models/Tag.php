<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
    /**
     * Get users who attach to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_tag', 'tag_id', 'user_id')->withTimestamps();
    }

    /**
     * Get contents which belong to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->belongsToMany('App\Models\Content', 'content_tag', 'tag_id', 'content_id')->withTimestamps();
    }

    /**
     * Get pages which belong to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'page_tag', 'tag_id', 'page_id')->withTimestamps();
    }


}
