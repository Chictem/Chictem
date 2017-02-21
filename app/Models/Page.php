<?php

namespace App\Models;

use App\Traits\ModelFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
	use Searchable, ModelFilter;

	protected $guarded = [];

	protected $filters = ['user_id', 'status'];

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
