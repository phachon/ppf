<?php
/**
 * Database DB
 * @package   Phachon\Database
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database;

use Phachon\Database\Query\Builder;

class DB {

	/**
	 * select from
	 * @param string $param
	 * @return object Builder\Select
	 */
	public static function select($param = NULL) {
		return new Builder\Select(func_get_args());
	}

	/**
	 * insert into
	 * @param string $table
	 * @return object Builder\Insert
	 */
	public static function insert($table) {
		return new Builder\Insert($table);
	}

	/**
	 * delete table
	 * @param string $table
	 * @return object Builder\Delete
	 */
	public static function delete($table) {
		return new Builder\Delete($table);
	}

	/**
	 * update table
	 * @param string $table
	 * @return object Builder\Update
	 */
	public static function update($table) {
		return new Builder\Update($table);
	}

	/**
	 * select count('*')
	 * @param string $param
	 * @return Builder\Count
	 */
	public static function count($param) {
		return new Builder\Count();
	}
}