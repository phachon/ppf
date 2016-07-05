<?php
/**
 * Phachon Core
 * @package   Phachon\Core
 * @category  Core
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Core;

class PhachonCore {

	/**
	 * VERSION
	 * @var string
	 */
	const VERSION = '1.0';

	/**
	 * PHP 5.3 以上
	 */
	const PHP_LOWER_VERSION = '5.3';

	/**
	 * environment
	 * @var integer
	 */
	const PRODUCTION = 1;
	const STAGING = 2;
	const TESTING = 3;
	const DEVELOPMENT = 4;

	/**
	 * environment
	 * @var int
	 */
	public static $environment = 4;

	/**
	 * 初始化
	 */
	public static function init() {

		self::_checkPhpVersion();
		self::_checkLogsDir();
		self::_checkCacheDir();
	}

	/**
	 * 检查 php 版本不能低于5.3
	 */
	private static function _checkPhpVersion() {
		if(version_compare(self::PHP_LOWER_VERSION, PHP_VERSION, ">")) {
			die("PHP 5.3 or greater is required!!!");
		}
	}

	/**
	 * 检查 log 文件夹
	 */
	private static function _checkLogsDir() {
		if(!is_readable(LOG_DIR)) {
			die("cache dir is not readable");
		}
		if(!is_writable(LOG_DIR)) {
			die("cache dir is not writable");
		}
	}

	/**
	 * 检查 cache 文件夹
	 */
	private static function _checkCacheDir() {
		if(!is_readable(CACHE_DIR)) {
			die("cache dir is not readable");
		}
		if(!is_writable(CACHE_DIR)) {
			die("cache dir is not writable");
		}
	}

	/**
	 * 加载日志配置
	 */
	public static function setLogs() {
		
	}

	/**
	 * 加载配置文件
	 */
	public static function loadConfig() {

	}

	/**
	 * 加载模块
	 */
	public static function loadModule() {

	}
}