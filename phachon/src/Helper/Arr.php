<?php
/**
 * Array Helper
 * @package   Phachon
 * @category  Helper
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Helper;

class Arr {

	/**
	 * 分隔符
	 * @var string
	 */
	public static $delimiter = '.';

	/**
	 * is_array
	 * Arr::is_array($data)
	 * @param mixed $array
	 * @return bool
	 */
	public static function is_array ($array) {
		if(is_array($array)) {
			return TRUE;
		}else {
			return (is_object($array) AND $array instanceof \Traversable);
		}
	}

	/**
	 * array is assoc
	 * Arr::is_assoc(array ('name', 'password')) => FALSE
	 * Arr::is_assoc(array ('name' => 'password')) => TRUE
	 * @param array $array
	 * @return boolean
	 */
	public static function is_assoc(array $array) {
		return array_keys($array) !== range(0, count($array) - 1);
	}

	/**
	 * array get value
	 * Arr::get($array, 'name', '');
	 * @param array $array
	 * @param mixed $key
	 * @param mixed $default
	 * @return mixed
	 */
	public static function get(array $array, $key, $default) {
		return isset($array[$key]) ? $array[$key] : $default;
	}

	/**
	 * Array get a value by path
	 * Arr::getPath($array, 'name.Tony', '')
	 * @param array $array
	 * @param string $path
	 * @param mixed $default
	 * @param null $delimiter
	 * @return mixed
	 * @throws \Exception
	 */
	public static function getPath($array, $path, $default = '', $delimiter = NULL) {
		if(!static::is_array($array)) {
			return $default;
		}

		if(is_array($path)) {
			$keys = $path;
		} else {
			if(array_key_exists($path, $array)) {
				return $array[$path];
			}
			if($delimiter === NULL) {
				$delimiter = trim(static::$delimiter);
			}
			$keys = explode($delimiter, $path);
		}

		for ($i = 0; $i < count($keys); $i++) {
			if(!isset($array[$keys[$i]])) {
				throw new \Exception('array key '. $keys[$i]. 'not found');
			}
			$array = $array[$keys[$i]];
		}
		return $array;
	}

	/**
	 * set a value by path
	 * Arr::setPath($array, 'name.tom.age', '18', '.');
	 * @param array $array
	 * @param string $path
	 * @param mixed $value
	 * @param mixed $delimiter
	 * @return array
	 * @throws \Exception
	 */
	public static function setPath(array $array, $path, $value, $delimiter = NULL) {
		if(isset($array[$path])) {
			$array[$path] = $value;
			return $array;
		}
		if($delimiter === NULL) {
			$delimiter = static::$delimiter;
		}

		$keys = explode($delimiter, $path);
		while (count($keys) > 1) {

			$key = array_shift($keys);
			if (! isset($array[$key]) || ! is_array($array[$key])) {
				$array[$key] = array();
			}
			$array = &$array[$key];
		}
		$array[array_shift($keys)] = $value;

		return $array;

	}
}