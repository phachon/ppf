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
use Phachon\Core\Exception;
use Phachon\Helper\Arr as Arr;
use Phachon\Helper\Strings as Strings;
use Phachon\Core\PhachonCore as Phachon;
use Phachon\Interfaces\Router\Routing as RouterInterface;

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
	 * @throws Exception
	 */
	public static function factory($type, array $defaults = array()) {
		$type = Strings::firstToLower($type);

		self::$defaultModule = Arr::get($defaults, 'module', '');
		self::$defaultController = Arr::get($defaults, 'controller', 'Index');
		self::$defaultMethod = Arr::get($defaults, 'method', 'Index');

		$className = 'Phachon\\Route\\Type\\'.$type;
		if(!class_exists($className)) {
			throw new Exception("route type $type not found");
		}
		return new $className();
	}

	/**
	 * router dispatcher
	 * @return mixed
	 * @throws Exception
	 */
	public function dispatcher() {
		$this->analyse();

		if(Phachon::$module) {
			$controller = 'App\\'.$this->getModule().'\\Controller\\'.$this->getController();
		}else {
			$controller = 'App\\Controller\\'.$this->getController();
		}
		if(!class_exists($controller)) {
			throw new Exception("controller $controller not found");
		}
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
		return Strings::firstToLower($this->_module);
	}

	/**
	 * @return string
	 */
	public function getController() {
		return Strings::firstToLower($this->_controller);
	}

	/**
	 * @return string
	 */
	public function getMethod() {
		return Strings::firstToLower($this->_method);
	}
}