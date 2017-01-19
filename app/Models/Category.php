<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = ['slug', 'name'];

	public function posts()
	{
		return $this->hasMany(Post::class)->published()->orderBy('created_at', 'DESC');
	}
}
