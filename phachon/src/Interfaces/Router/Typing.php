<?php
/**
 * Router Type interface
 * @package   Phachon\Interfaces\Router
 * @category  Router
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Interfaces\Router;


interface Typing {

	/**
	 * 默认方式（路径+传参）
	 * http://phachon.com/video/category?id=667887
	 */
	const ROUTE_DEFAULTS = 'defaults';

	/**
	 * 原生传参方式路由
	 * http://phachon.com?m=video&c=category&a=add&id=67887
	 */
	const ROUTE_NATIVE = 'native';

	/**
	 * 路径方式路由
	 * http://phachon.com/video/category/id/5767756
	 */
	const ROUTE_PATHINFO = 'pathinfo';
	
	/**
	 * 解析
	 * @return mixed
	 */
	public function analyse();
}