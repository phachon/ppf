<?php
/**
 * 类容器
 * @package   Phachon\Service
 * @category  Service
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Service;

use Phachon\Interfaces\Service\Container as PhachonContainerInterface;

class Container implements PhachonContainerInterface {

	/**
	 * 对象树
	 * @var array
	 */
	protected static $objectTree = array ();

	/**
	 * 注册一个对象
	 * @param $object
	 * @param $key
	 * @return null
	 */
	public static function register($key, $object) {
		self::$objectTree[$key] = $object;
	}

	/**
	 * 魔术静态方法获取一个对象
	 * @param $name
	 * @param $arguments
	 * @return null | object
	 */
	public static function __callStatic($name, $arguments) {
		if(!key_exists($name, self::$objectTree)) {
			return null;
		}
		return self::$objectTree[$name];
	}
}