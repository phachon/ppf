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


class Query {

	protected $_sql = '';

	public function __construct() {

	}

	public function execute($db) {
//		echo "<pre/>";
		$this->complete();
		Database::instance($db);

		echo $this->_sql;
	}

	public function as_array() {

	}

	public function as_object() {

	}

	public function get() {

	}
}