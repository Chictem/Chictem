<?php

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
     * Generate url by array.
     *
     * @param $url
     * @param array|null $array
     * @return string
     */
    function make_url_para($url, array $array = null)
    {
        $url = url($url);
        if ($array) {
            $url .= '?';
            foreach ($array as $key => $value) {
                $url .= ($key . '=' . $value);
            }
        }
        return $url;
    }
}

if (! function_exists('get_url_para')) {
    /**
     * Get parameters like ?foo=bar.
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
     * Convert date_to_constellation.
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