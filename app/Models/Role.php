<?php

namespace App\Models;

use App\Traits\ModelFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use Searchable, ModelFilter;

	protected $guarded = [];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany(User::class, 'user_roles');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany(Permission::class);
	}
}
