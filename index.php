<?php
/**
 * 入口文件
 * @package   Phachon
 * @category  Index
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

/**
 * 相对路径
 * @var string
 */
$application = 'app';

/**
 * 框架目录相对路径
 * @var string
 */
$phachon = 'phachon';

/**
 * 文件后缀
 */
define('EXT', '.php');

/**
 * 错误等级
 */
error_reporting(E_ALL | E_STRICT);

/**
 * 定义
 */
define('PHACHON', 'A PHP Framework');

/**
 * 根目录
 */
define('ROOT_DIR', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

/**
 * 框架目录
 */
define('PHACHON_DIR', realpath($phachon).DIRECTORY_SEPARATOR);

/**
 * 项目绝对路径
 */
define('APP_DIR', realpath($application).DIRECTORY_SEPARATOR);

/**
 * 项目名称
 */
define('APP_NAME', 'app');

/**
 * 入口文件
 */
define('PORTAL', basename(__FILE__));

/**
 * 模块
 */
define('MODULE_DIR', '/');

/**
 * 缓存路径
 */
define('CACHE_DIR', realpath($application.'/cache').DIRECTORY_SEPARATOR);

/**
 * 日志路径
 */
define('LOG_DIR', realpath($application.'/logs').DIRECTORY_SEPARATOR);

/**
 * 配置路径
 */
define('CONF_DIR', realpath($application.'/config').DIRECTORY_SEPARATOR);

/**
 * 启动文件
 */
require APP_DIR . 'bootstrap'.EXT;
