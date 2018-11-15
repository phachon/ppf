<?php
/**
 * Route default
 * @package   Phachon\Route\Type
 * @category  Route
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Route\Type;

use Phachon\Helper\Arr;
use Phachon\Service\Container;
use Phachon\Route\Router as Router;
use Phachon\Core\PhachonCore as Phachon;
use Phachon\Interfaces\Router\Typing as RouteTypeInterface;

class Defaults extends Router implements RouteTypeInterface {

	/**
	 * Defaults constructor.
	 */
	public function __construct() {

	}

	/**
	 * 解析
	 * http://phachon.com/video/category?id=667887
	 * @return mixed
	 */
	public function analyse() {
		$pathInfo = Container::request()->getPathInfo();
		$urlParams = array_filter(explode('/', $pathInfo));
		if(!count($urlParams)) {
			$this->_module = self::$defaultModule;
			$this->_controller = self::$defaultController;
			$this->_method = self::$defaultMethod;
			return 1;
		}
		
		// index true
		if(!Phachon::$index) {
			if(isset($urlParams['index.php'])) {
				unset($urlParams['index.php']);
			}
		}

		//hmvc is true
		if(Phachon::$hmvc) {
			$this->_module = isset($urlParams[1]) ? $urlParams[1] : $this->_module;
			$this->_controller = isset($urlParams[2]) ? $urlParams[2] : $this->_controller;
			$this->_method = isset($urlParams[3]) ? $urlParams[3] : $this->_method;
		}else {
			$this->_controller = isset($urlParams[1]) ? $urlParams[1] : $this->_controller;
			$this->_method = isset($urlParams[2]) ? $urlParams[2] : $this->_method;
		}
		return 1;
	}
}