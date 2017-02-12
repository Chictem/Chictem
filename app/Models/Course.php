<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App\Models
 * @version January 20, 2017, 3:40 am CST
 */
class Course extends Model
{
	use SoftDeletes;

	public $table = 'courses';


	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $guarded = [];
	
	protected $perPage = 6;
	
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'name' => 'string',
		'description' => 'string',
		'url' => 'string'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required',
		'description' => 'required',
		'url' => 'required',
	];

	/**
	 * Voyager select dropdown relationships
	 *
	 * @return mixed
	 */
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/**
	 * Voyager select dropdown relationships
	 *
	 * @return mixed
	 */
	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}

	/**
	 * Voyager select dropdown relationships
	 *
	 * @return mixed
	 */
	public function company()
	{
		return $this->belongsTo(Company::class);
	}

}
