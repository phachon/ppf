<?php
/**
 * Database Query
 * @package   Phachon\Database
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database;

use Phachon\Service\Container as Container;

class Query {

	protected $_sql = '';

	public function __construct() {
		
	}

	public function execute($db) {
		$this->complete();

		$config = Container::config()->load('database.' . $db);

		$database = Database::factory($config['type'])
			->host($config['host'])
			->port($config['port'])
			->user($config['user'])
			->password($config['password'])
			->database($config['database'])
			->charset($config['charset'])
			->connect();
//		echo $this->_sql;
//		exit();
//		$result = $database->query($this->_sql);

	}

	public function as_array() {

	}

	public function as_object() {

	}

	public function get() {

	}

	public function __toString() {
		return $this->_sql;
	}
}