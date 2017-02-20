<?php

namespace App\Traits;


trait ModelFilter
{
	/**
	 * @return array
	 */
	public function getFilters()
	{
		return $this->filters;
	}
}