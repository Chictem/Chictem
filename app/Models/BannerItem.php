<?php

namespace App\Models;

use App\Facades\Voyager;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerItem extends Model
{
	use SoftDeletes;

	public $table = 'banner_items';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'name',
		'banner_id',
		'description',
		'url',
		'image',
	    'image_url'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
		'banner_id' => 'integer',
		'description' => 'string',
		'url' => 'string',
		'image' => 'string',
		'image_url' => 'string'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required',
		'banner_id' => 'required'
	];

	/**
	 * @param $image
	 * @return mixed
	 */
	public function getImageAttribute($image)
	{
		if ($image_url = $this->attributes['image_url']) {
			return $image_url;
		} else if ($image) {
			return Voyager::image($image);
		}
		return null;
	}

}
