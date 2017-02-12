<?php

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