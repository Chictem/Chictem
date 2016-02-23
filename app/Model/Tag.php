<?php

namespace App\Model;

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
        return $this->belongsToMany('App\Model\User', 'user_tag', 'tag_id', 'user_id')->withTimestamps();
    }

    /**
     * Get contents which belong to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->belongsToMany('App\Model\Content', 'content_tag', 'tag_id', 'content_id')->withTimestamps();
    }

    /**
     * Get pages which belong to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->belongsToMany('App\Model\Page', 'page_tag', 'tag_id', 'page_id')->withTimestamps();
    }


}
