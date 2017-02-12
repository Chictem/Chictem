<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function getSlug(Request $request)
	{
		if (isset($this->slug)) {
			$slug = $this->slug;
		} else {
			$slug = explode('.', $request->route()->getName())[0];
		}

		return $slug;
	}
}
