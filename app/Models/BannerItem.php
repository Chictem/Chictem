<?php

namespace App\Models;

use App\Facades\Voyager;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="BannerItem",
 *      required={"title", "banner_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="banner_id",
 *          description="banner_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class BannerItem extends Model
{
	use SoftDeletes;

	public $table = 'banner_items';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'title',
		'banner_id',
		'description',
		'url',
		'image'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'title' => 'string',
		'banner_id' => 'integer',
		'description' => 'string',
		'url' => 'string',
		'image' => 'string'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'title' => 'required',
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
