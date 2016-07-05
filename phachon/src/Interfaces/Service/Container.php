<?php
/**
 * container interface
 * @package   Phachon\Interfaces\Service
 * @category  container
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Interfaces\Service;


interface Container {

	/**
	 * 注册
	 * @param string $key
	 * @param string $object
	 * @return mixed
	 */
	public static function register($key, $object);
}