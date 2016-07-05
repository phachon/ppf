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
use Phachon\Route\Router as Router;
use Phachon\Interfaces\Router\Typing as RouteTypeInterface;

class Defaults extends Router implements RouteTypeInterface{

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
		$url = $_SERVER['PHP_SELF'];
		$url = str_replace('/'.PORTAL, '', $url);
		if(!$url) {
			$this->_module = self::$defaultModule;
			$this->_controller = self::$defaultController;
			$this->_method = self::$defaultMethod;
			return 1;
		}
		$urlParams = explode('/', $url);
		$this->_module = $urlParams[1];
		$this->_controller = $urlParams[2];
		$this->_method = $urlParams[3];
		return 1;
	}
}