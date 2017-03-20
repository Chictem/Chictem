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
				$details = json_decode($column->details);
				if ($column->type == 'select_dropdown' && isset($details->relationship)) {
					$label = $details->relationship->label;
					// Has relationship
					$query = $query->orWhereHas(camel_case(str_replace('_id', '', $column->field)), function ($query) use ($label, $search, $column) {
						// If text, ignore case
//						if (in_array($column->type, ['text', 'text_area', 'rich_text_box'])) {
//							return $query->where('LOWER(' . $label . ')', 'like', '%' . strtolower($search) . '%');
//						} else {
							return $query->where($label, 'like binary', '%' . $search . '%');
//						}
					});
					// Not has relationship
				} else {
					// If text, ignore case
//					if (in_array($column->type, ['text', 'text_area', 'rich_text_box'])) {
//						$query = $query->orWhere('LOWER(' . $column->field . ')', 'like', '%' . strtolower($search) . '%');
//					} else {
						$query = $query->orWhere($column->field, 'like binary', '%' . $search . '%');
//					}
				}
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
