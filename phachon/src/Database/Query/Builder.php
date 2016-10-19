<?php
/**
 * Database Query Builder
 * @package   Phachon\Database\Query
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database\Query;


use Phachon\Database\Query;

abstract class Builder extends Query {

	protected $_where = array();

	protected $_table = '';

	public static function factory() {

	}

	/**
	 * where
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function where($column, $sign, $value) {
		$this->and_where($column, $sign, $value);
		return $this;
	}

	/**
	 * and_where
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function and_where($column, $sign, $value) {
		$this->_where[] = array ('AND', array ($column, $sign, $value));
		return $this;
	}

	/**
	 * or_where
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function or_where($column, $sign, $value) {
		$this->_where[] = array ('OR', array ($column, $sign, $value));
		return $this;
	}

	public function where_open() {

	}

	public function and_where_open() {

	}

	public function or_where_open() {

	}

	public function where_close() {

	}

	public function and_where_close() {

	}

	public function or_where_close() {

	}

	protected function _compileWhere(array $conditions) {

		$whereSql = '';
		foreach ($conditions as $condition) {
			foreach ($condition as $option => $values) {
				if(is_array($values)) {
					$whereSql .= implode('', $values);
				}else {
					$whereSql .= ' ' .$values . ' ';
				}
			}
		}

		return $whereSql;
	}

	abstract public function complete();
}