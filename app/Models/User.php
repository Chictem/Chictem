<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Traits\VoyagerUser;

class User extends AuthUser
{
	use VoyagerUser;

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

	/**
	 * On save make sure to set the default avatar if image is not set.
	 */
	public function save(array $options = [])
	{
		// If no avatar has been set, set it to the default
		if (! $this->image) {
			$this->image = 'users/default.png';
		}

		parent::save();
	}

	public function getNameAttribute($value)
	{
		return ucwords($value);
	}

}
