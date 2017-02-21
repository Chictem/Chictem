<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataType extends Model
{
	protected $table = 'data_types';

	protected $guarded = [];

	public function rows()
	{
		return $this->hasMany(DataRow::class);
	}

	/**
	 * @return mixed
	 */
	public function browseRows()
	{
		return $this->rows()->where('browse', '=', 1);
	}

	/**
	 * @return mixed
	 */
	public function readRows()
	{
		return $this->rows()->where('read', '=', 1);
	}

	/**
	 * @return mixed
	 */
	public function editRows()
	{
		return $this->rows()->where('edit', '=', 1);
	}

	/**
	 * @return mixed
	 */
	public function addRows()
	{
		return $this->rows()->where('add', '=', 1);
	}

	/**
	 * @return mixed
	 */
	public function deleteRows()
	{
		return $this->rows()->where('delete', '=', 1);
	}

	/**
	 * @return mixed
	 */
	public function showRows()
	{
		return $this->rows()->where('show', '=', 1);
	}

	/**
	 * @param $field
	 * @return mixed
	 */
	public function row($field)
	{
		return $this->hasMany(DataRow::class)->where('field', $field)->first();
	}

	/**
	 * @param $value
	 */
	public function setGeneratePermissionsAttribute($value)
	{
		$this->attributes['generate_permissions'] = $value ? 1 : 0;
	}

	/**
	 * @param $value
	 */
	public function setServerSideAttribute($value)
	{
		$this->attributes['server_side'] = $value ? 1 : 0;
	}

	/**
	 * @param $requestData
	 * @return bool
	 */
	public function updateDataType($requestData)
	{
		$success = true;
		$fields = $this->fields();

		foreach ($fields as $field) {
			$dataRow = DataRow::where('data_type_id', '=', $this->id)->where('field', '=', $field)->first();

			if (! isset($dataRow->id)) {
				$dataRow = new DataRow();
			}

			$dataRow->data_type_id = $this->id;
			$dataRow->required = $requestData['field_required_' . $field];

			foreach (['browse', 'read', 'edit', 'add', 'delete', 'show'] as $check) {
				if (isset($requestData["field_{$check}_{$field}"])) {
					$dataRow->{$check} = 1;
				} else {
					$dataRow->{$check} = 0;
				}
			}

			$dataRow->field = $requestData['field_' . $field];
			$dataRow->type = $requestData['field_input_type_' . $field];
			$dataRow->details = $requestData['field_details_' . $field];
			$dataRow->display_name = $requestData['field_display_name_' . $field];
			$dataRowSuccess = $dataRow->save();

			// If success has never failed yet, let's add DataRowSuccess to success
			if ($success !== false) {
				$success = $dataRowSuccess;
			}
		}

		$requestData = array_filter($requestData, function ($value, $key) {
			return strpos($key, 'field_') !== 0;
		}, ARRAY_FILTER_USE_BOTH);


		if (!array_has($requestData, 'server_side')) {
			$requestData['server_side'] = 0;
		}

		if (!array_has($requestData, 'generate_permissions')) {
			$requestData['generate_permissions'] = 0;
			Permission::removeFrom($this->name);
		}

		$success = $success && $this->fill($requestData)->save();

		if ($this->generate_permissions) {
			Permission::generateFor($this->name);
		}

		return $success !== false;
	}

	/**
	 * @return array
	 */
	public function fields()
	{
		$fields = Schema::getColumnListing($this->name);

		if ($extraFields = $this->extraFields()) {
			foreach ($extraFields as $field) {
				$fields[] = $field['Field'];
			}
		}

		return $fields;
	}

	/**
	 * @return array
	 */
	public function fieldOptions()
	{
		$table = $this->name;

		$fieldOptions = DB::select("DESCRIBE ${table}");

		if ($extraFields = $this->extraFields()) {
			foreach ($extraFields as $field) {
				$fieldOptions[] = (object)$field;
			}
		}

		return $fieldOptions;
	}

	/**
	 * @return mixed
	 */
	public function extraFields()
	{
		$model = app($this->model_name);

		if (method_exists($model, 'adminFields')) {
			return $model->adminFields();
		}
	}
}
