<?php
/**
 * String Helper
 * @package   Phachon\Helper
 * @category  helper
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Helper;

class Strings {

	/**
	 * 首字母大写，其余小写
	 * @param string $string
	 * @return string
	 */
	public static function firstToLower($string = '') {
		return ucfirst(strtolower($string));
	}
}