<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Traits\VoyagerUser;
use App\Traits\ModelFilter;
use App\Traits\Searchable;

class User extends AuthUser
{
	use VoyagerUser, ModelFilter, Searchable;

	/**
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $filters = [
		'role_id'
	];

	/**
	 * On save make sure to set the default avatar if image is not set.
	 */
	public function save(array $options = [])
	{
		if (! $this->image) {
			$this->image = 'users/default.png';
		}

		parent::save();
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getNameAttribute($value)
	{
		return ucwords($value);
	}

}
