<?php

namespace App\Traits;


use App\Models\DataType;

trait Searchable
{
	public function scopeSearch($query, $search)
	{
		$columns = $this->toSearchableArray();
		return $query->where(function ($query) use ($search, $columns) {
			foreach ($columns as $column) {
				$query = $query->orWhere($column->field, 'like', '%' . $search . '%');
			}
			return $query;
		});
	}

	/**
	 * Get the index name for the model.
	 *
	 * @return string
	 */
	public function searchableAs()
	{
		return config('scout.prefix') . $this->getTable();
	}

	/**
	 * @return mixed
	 */
	public function toSearchableArray()
	{
		if ($model = DataType::where('slug', $this->searchableAs())->first()) {
			return $model->searchRows;
		}
		return [];
	}
}
