<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


if (! function_exists('assoc_to_index')) {
	/**
	 * Generate a URL to a named route.
	 *
	 * @param  string $route
	 * @param  string $parameters
	 * @return string
	 */
	function assoc_to_index(array $array)
	{
		if (! (count($array) >= 0)) {
			return [];
		}
		$keys = array_keys($array);
		$item_keys = array_keys($array[array_keys($array)[0]]);
		$result = [];
		foreach ($item_keys as $item_key) {
			foreach ($keys as $key) {
				$temp[$key] = $array[$key][$item_key];
			}
			array_push($result, $temp);
		}
		return $result;
	}
}


if (! function_exists('make_url_para')) {

	/**
	 * Generate url by array
	 *
	 * @param $url
	 * @param array|null $array
	 * @return string
	 */
	function make_url_para($url, array $array = null, array $extra = null)
	{
		$url = url($url);
		if ($extra) {
			$array = array_merge($array, $extra);
		}
		if ($array) {
			$paras = [];
			foreach ($array as $key => $value) {
				if ($value) {
					array_push($paras, $key . '=' . $value);
				}
			}
			if (count($paras)) {
				$url .= ('?' . join('&', $paras));
			}
		}
		return $url;
	}
}

if (! function_exists('get_url_para')) {

	/**
	 * Get parameters like ?foo=bar
	 *
	 * @param $url
	 * @param array|null $array
	 * @return string
	 */
	function get_url_para(Request $request, $key = null)
	{
		if ($key) {
			return $request->query->get($key);
		}
		return $request->query->all();
	}
}


if (! function_exists('is_serialized')) {

	/**
	 * If data is serialized.
	 *
	 * @param $data
	 * @return bool
	 */
	function is_serialized($str)
	{
		return ($str == serialize(false) || @unserialize($str) !== false);
	}
}


if (! function_exists('get_short')) {
	/**
	 * Get short content of a string.
	 *
	 * @param $str_cut
	 * @param int $length
	 * @return string
	 */
	function get_short($string, $length = 30)
	{
		if (mb_strlen($string, 'utf-8') >= $length) {
			return mb_substr($string, 0, $length, 'utf-8') . '...';
		}
		return $string;
	}

}


if (! function_exists('date_to_constellation')) {
	/**
	 * Convert date_to_constellation
	 *
	 * @param $month
	 * @param $day
	 * @return bool
	 */
	function date_to_constellation($date)
	{
		$month = date('m', strtotime($date));
		$day = date('d', strtotime($date));
		if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
			return false;
		$constellations = array(
			array("20" => '水瓶座'),
			array("19" => '双鱼座'),
			array("21" => '白羊座'),
			array("20" => '金牛座'),
			array("21" => '双子座'),
			array("22" => '巨蟹座'),
			array("23" => '狮子座'),
			array("23" => '处女座'),
			array("23" => '天秤座'),
			array("24" => '天蝎座'),
			array("22" => '射手座'),
			array("22" => '摩羯座')
		);
		list($constellation_start, $constellation_name) = each($constellations[(int)$month - 1]);
		if ($day < $constellation_start)
			list($constellation_start, $constellation_name) = each($constellations[($month - 2 < 0) ? $month = 11 : $month -= 2]);
		return $constellation_name;
	}
}


if (! function_exists('is_me')) {
	/**
	 * Judge if the user is the login user.
	 *
	 * @param $user_id
	 * @return bool
	 */
	function is_me($user_id)
	{
		if (! Auth::user()) {
			return false;
		} else if (Auth::user()->id == $user_id) {
			return true;
		} else {
			return false;
		}
	}
}

if (! function_exists('has_role')) {
	/**
	 * Judge if the user is the login user.
	 *
	 * @param $user_id
	 * @return bool
	 */
	function has_role($role, $user_id)
	{
		$user = User::find($user_id);
		if (! $user) {
			return false;
		}
		if ($user->hasRole($role)) {
			return true;
		} else {
			return false;
		}

	}
}


if (! function_exists('is_json')) {
	/**
	 * Judge whether the string is json or not.
	 *
	 * @param $string
	 * @return bool
	 */
	function is_json($string)
	{
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}

if (! function_exists('array_excepts')) {
	/**
	 * Delete element from array which in except.
	 *
	 * @param $array
	 * @param $except
	 * @return $array
	 */
	function array_excepts($array, $except)
	{
		foreach ($except as $item) {
			unset($array[array_search($item, $array)]);
		}
		return $array;
	}
}

if (! function_exists('is_email')) {
	/**
	 * Judge if email.
	 *
	 * @param $string
	 * @return bool
	 */
	function is_email($string)
	{
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if (preg_match($pattern, $string)) {
			return true;
		}
		return false;
	}
}

if (! function_exists('is_phone')) {
	/**
	 * Judge if email.
	 *
	 * @param $string
	 * @return bool
	 */
	function is_phone($string)
	{
		if ((strlen($string) != 11) || ! (preg_match("/13[0123456789]{1}\d{8}|15[012356789]\d{8}|18[0123456789]\d{8}|17[0678]\d{8}|14[57]\d{8}/", $string))) {
			return false;
		}
		return true;
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

if (! function_exists('thumb')) {
	/**
	 * Return thumb of image.
	 *
	 * @param $src
	 * @param int $width
	 * @param int $height
	 * @return mixed
	 */
	function thumb($src, $width = 0, $height = 0)
	{
		if (in_str($src, env('QINIU_CDN_URL'))) {
			return $src . '-thumb';
		}
		return '/image/thumb?src=' . urlencode($src) . ($width ? '&width=' . $width : '&width=320') . ($height ? '&height=' . $height : '&height=160');
	}
}

if (! function_exists('banner')) {
	/**
	 * Return banner of image.
	 *
	 * @param $src
	 * @param int $width
	 * @param int $height
	 * @return mixed
	 */
	function banner($src, $width = 0, $height = 0)
	{
		if (in_str($src, env('QINIU_CDN_URL'))) {
			return $src . '-banner';
		}
		return '/image/thumb?src=' . urlencode($src) . ($width ? '&width=' . $width : '&width=1800') . ($height ? '&height=' . $height : '&height=250');

	}
}

if (! function_exists('http')) {
	/**
	 * Get http url.
	 *
	 * @param $url
	 * @return string
	 */
	function http($url)
	{
		if (! starts_with($url, 'http')) {
			return 'http://' . $url;
		}
	}
}

if (! function_exists('https')) {
	/**
	 * Get http url.
	 *
	 * @param $url
	 * @return string
	 */
	function https($url)
	{
		if (! starts_with($url, 'http')) {
			return 'https://' . $url;
		}
	}
}

if (! function_exists('file_size')) {
	/**
	 * Get file size.
	 *
	 * @param $size
	 * @param string $unit
	 * @return string
	 */
	function file_size($size, $unit = "")
	{
		if ((! $unit && $size >= 1 << 30) || $unit == "GB")
			return number_format($size / (1 << 30), 2) . "GB";
		if ((! $unit && $size >= 1 << 20) || $unit == "MB")
			return number_format($size / (1 << 20), 2) . "MB";
		if ((! $unit && $size >= 1 << 10) || $unit == "KB")
			return number_format($size / (1 << 10), 2) . "KB";
		return number_format($size) . "B";
	}
}

if (! function_exists('plugins')) {
	/**
	 * @param $path
	 * @return string
	 */
	function plugins($path)
	{
		return url('/plugins/' . $path . '/');
	}
}

if (! function_exists('vendor')) {
	/**
	 * @param $path
	 * @return string
	 */
	function vendor($path)
	{
		return url('/vendor/' . $path . '/');
	}
}

if (! function_exists('manage')) {
	/**
	 * @param $path
	 * @return string
	 */
	function manage($path)
	{
		return url('/manage/' . $path . '/');
	}
}

if (! function_exists('theme')) {
	/**
	 * @param $path
	 * @return string
	 */
	function theme($name, $path)
	{
		return url('/themes/' . $name . '/' . $path . '/');
	}
}