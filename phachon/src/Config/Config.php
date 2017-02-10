<?php
/**
 *  Config
 * @package   Phachon\Config
 * @category  config
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Config;

use Phachon\Exception\Base as Exception;
use Phachon\Core\PhachonCore as Phachon;
use Phachon\Exception\Base;

class Config {

	/**
	 * config groups
	 * @var array
	 */
	protected $_groups = array();

	/**
	 * default config
	 * @var string
	 */
	protected $_default = 'default';

	/**
	 * instance
	 * @var null
	 */
	protected static $_instance = NULL;

	/**
	 * @return null|Config
	 */
	public static function instance() {
		if(self::$_instance == NULL) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function load($group) {
		if(!$group) {
			throw new Exception('Need to a config group');
		}
		
		if(!is_string($group)) {
			throw new Exception('Config group must be a string');
		}

		if(strpos($group, '.')) {
			list($group, $path) = explode('.', $group, 2);
		}

		if(!isset($this->_groups[$group])) {
			$groupFile = Phachon::$configPath . $group . '.php';
			$groupArray = include_once $groupFile;
			$this->_groups[$group] = $groupArray;
		}

		$array = $this->_groups[$group];
		if(isset($path)) {

			$keys = explode('.', $path);

			do {
				$key = array_shift($keys);
				if(isset($array[$key])) {
					$array = $array[$key];
				}else {
					throw new Exception("Config group $group not found key: $key");
				}

			}while($keys);

			return $array;
		}

		return $array;
	}
}