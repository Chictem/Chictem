<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class DataRow extends Model
{
	use Searchable;
	
	protected $table = 'data_rows';

	protected $guarded = [];

	public $timestamps = false;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataType()
	{
		return $this->belongsTo(DataType::class, 'data_type_id', 'id');
	}
}
