<?php
/**
 * router
 * @package   Phachon\Route
 * @category  router
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Route;

use Phachon\Route\Type;
use Phachon\Helper\Arr as Arr;
use Phachon\Helper\Strings as Strings;
use Phachon\Interfaces\Router\Routing as RouterInterface;
use Phachon\Controller\Test as TestController;

class Router implements RouterInterface {
	
	/**
	 * 默认的模块
	 * @var string
	 */
	public static $defaultModule = 'Index';

	/**
	 * 默认的控制器
	 * @var string
	 */
	public static $defaultController = 'Index';

	/**
	 * 默认的方法
	 * @var string
	 */
	public static $defaultMethod = 'Index';

	/**
	 * 模块
	 * @var string
	 */
	protected $_module = '';

	/**
	 * 控制器
	 * @var string
	 */
	protected $_controller = '';

	/**
	 * 方法
	 * @var string
	 */
	protected $_method = '';

	/**
	 * Router constructor.
	 */
	public function __construct() {

	}

	/**
	 * factory
	 * @param $type
	 * @param array $defaults
	 * @return object
	 */
	public static function factory($type, array $defaults = array()) {
		$type = Strings::firstToLower($type);

		self::$defaultModule = Arr::get($defaults, 'module', 'Index');
		self::$defaultController = Arr::get($defaults, 'controller', 'Index');
		self::$defaultMethod = Arr::get($defaults, 'method', 'Index');
		$className = 'Phachon\\Route\\Type\\'.$type;
		return new $className();
	}

	/**
	 * router dispatcher
	 * @return mixed
	 */
	public function dispatcher() {
		$this->analyse();
		$controller = 'App\\Controller\\'.$this->_controller;
		$controller = new $controller();
		$controller->execute();
	}

	/**
	 * router error
	 * @return mixed
	 */
	public static function error() {

	}

	/**
	 * @return string
	 */
	public function getModule() {
		return $this->_module;
	}

	/**
	 * @return string
	 */
	public function getController() {
		return $this->_controller;
	}

	/**
	 * @return string
	 */
	public function getMethod() {
		return $this->_method;
	}
}