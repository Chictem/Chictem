<?php

namespace App\Models;

use App\Traits\ModelFilter;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class DataRow extends Model
{
	use Searchable, ModelFilter;

	protected $table = 'data_rows';

	protected $guarded = [];

	public $timestamps = false;

	protected $filters = ['data_type_id', 'type', ''];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dataType()
	{
		return $this->belongsTo(DataType::class, 'data_type_id', 'id');
	}
}
