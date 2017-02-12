<?php

if (! function_exists('per_page_class')) {
	/**
	 * @param $per_page
	 * @return string
	 */
	function per_page_class($perPage)
	{
		$divide = 0;
		foreach ([4, 3, 2] as $div) {
			if ($perPage % $div == 0) {
				$divide = 1;
				$colClass = 'col-xs-12 col-md-' . (12 / $div);
				break;
			}
		}
		if (! $divide) {
			$colClass = 'col-xs-12';
			$div = 1;
		}
		return [$colClass, $div];
	}
}