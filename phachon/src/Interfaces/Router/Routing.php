<?php
/**
 * router interface
 * @package   Phachon\Interfaces\Router
 * @category  router
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Interfaces\Router;


interface Routing {

	/**
	 * router dispatcher
	 * @return mixed
	 */
	public function dispatcher();

	/**
	 * router error
	 * @return mixed
	 */
	public static function error();
}