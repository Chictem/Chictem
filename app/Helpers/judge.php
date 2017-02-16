<?php

use Illuminate\Http\Request;

if (! function_exists('is_url')) {
	/**
	 * @param $string
	 * @return int
	 */
	function is_url($string)
	{
		$regex = "((https?|ftp)\:\/\/)?"; // SCHEME
		$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
		$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
		$regex .= "(\:[0-9]{2,5})?"; // Port
		$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
		$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
		$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

		if (preg_match("/^$regex$/i", $string)) // `i` flag for case-insensitive
		{
			return true;
		}
	}
}


if (! function_exists('start_with_digit')) {
	/**
	 * @param $string
	 * @return bool
	 */
	function start_with_digit($string)
	{
		return preg_match('/^\d/', $string) === 1;
	}
}

if (! function_exists('in_str')) {
	/**
	 * Judge if target in string.
	 *
	 * @param $string
	 * @param $target
	 * @return bool
	 */
	function in_str($string, $target)
	{
		if (is_array($target)) {
			foreach ($target as $item) {
				if (strpos($string, $item) !== false)
					return true;
			}
			return false;
		} else {
			if (strpos($string, $target) !== false) {
				return true;
			} else {
				return false;
			}
		}

	}
}


if (! function_exists('is_active')) {
	/**
	 * @param Request $request
	 * @param $target
	 * @return string
	 */
	function is_active($target, $except = null)
	{
		$path_info = Request::capture()->getPathInfo();
		if ($target && in_str($path_info, $except)) {
			return '';
		}
		if (in_str($path_info, $target)) {
			return 'active';
		}
	}
}