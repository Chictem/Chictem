<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
	const PUBLISHED = 'PUBLISHED';

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

	/**
	 * Scope a query to only published scopes.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePublished(Builder $query)
	{
		return $query->where('status', '=', static::PUBLISHED);
	}
}
