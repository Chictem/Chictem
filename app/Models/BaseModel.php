<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	protected $filters = [];

	/**
	 * @return array
	 */
	public function getFilters()
	{
		return $this->filters;
	}
	
	
}