<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use Searchable;

	protected $table = 'categories';

	protected $fillable = ['slug', 'name'];
	
	/**
	 * @return mixed
	 */
	public function posts()
	{
		return $this->hasMany(Post::class)->published()->orderBy('created_at', 'DESC');
	}
}
