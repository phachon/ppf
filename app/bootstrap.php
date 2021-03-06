<?php
/**
 * bootstrap php
 * @package   bootstrap
 * @category  bootstrap
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

use Phachon\Route\Router as Router;
use Phachon\Config\Config as Config;
use Phachon\Http\Request as Request;
use Phachon\Http\Response as Response;
use Phachon\Core\PhachonCore as Phachon;
use Phachon\Service\Container as Container;
use Phachon\Interfaces\Router\Typing as RouterType;

if(is_file(ROOT_DIR . 'vendor/autoload.php')) {
	require ROOT_DIR . 'vendor/autoload.php';
}else {
	exit('not found vendor dir');
}
/**
 * 时区
 */
date_default_timezone_set('Asia/Shanghai');

/**
 * 编码
 */
setlocale(LC_ALL, 'zh_CN.utf-8');

/**
 * 环境变量
 */
if(!isset($_SERVER['ENVIRONMENT'])) {
	$_SERVER['ENVIRONMENT'] = 'DEVELOPMENT';
}
Phachon::$environment = constant('Phachon\Core\PhachonCore::'.strtoupper($_SERVER['ENVIRONMENT']));

/**
 * 错误显示
 */
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/**
 * 初始化
 */
Phachon::init(array(
	'hmvc' => TRUE, //HMVC
	'index' => FALSE, //去除index
));

/**
 * router
 */
$router = Router::factory(RouterType::ROUTE_DEFAULTS, array(
	'module' => 'index',
	'controller' => 'index',
	'method' => 'index'
));

/**
 * 注册
 */
Container::register('router', $router);
Container::register('whoops', $whoops);
Container::register('request', Request::createRequest());
Container::register('response', Response::createResponse());
Container::register('config', Config::instance());

/**
 * run
 */
$router->dispatcher();
