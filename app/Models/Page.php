<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
	protected $guarded = [];

	public function save(array $options = [])
	{
		// If no author has been assigned, assign the current user's id as the author of the post
		if (! $this->author_id && Auth::user()) {
			$this->author_id = Auth::user()->id;
		}

		parent::save();
	}
}
