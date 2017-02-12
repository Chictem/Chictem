<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
	protected $guarded = [];

	/**
	 * @param array $options
	 */
	public function save(array $options = [])
	{
		if (! $this->user_id && Auth::user()) {
			$this->user_id = Auth::user()->id;
		}
		parent::save();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
