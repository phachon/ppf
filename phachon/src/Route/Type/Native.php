<?php
/**
 * Route Native
 * @package   Phachon\Route\Type
 * @category  Route
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license MIT
 */

namespace Phachon\Route\Type;

use Phachon\Route\Exception;
use Phachon\Route\Router as Router;
use Phachon\Service\Container as Container;
use Phachon\Interfaces\Router\Typing as RouteTypeInterface;


class Native extends Router implements RouteTypeInterface{

	/**
	 * 解析
	 * @return mixed
	 * @throws Exception
	 */
	public function analyse() {
		$pathInfo = Container::request()->getPathInfo();
		if($pathInfo != '/') {
			throw new Exception('The path '. $pathInfo .' is not allowed.');
		}
		$this->_module = Container::request()->get('m', self::$defaultModule);
		$this->_controller = Container::request()->get('c', self::$defaultController);
		$this->_method = Container::request()->get('a', self::$defaultMethod);
		return 1;
	}
}