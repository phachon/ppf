<?php
/**
 * Database Query Builder Where
 * @package   Phachon\Database\Query\Builder
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database\Query\Builder;


use Phachon\Database\Query\Builder;

abstract class Where extends Builder {

	protected $_where = array();

	protected $_order_by = array();

	protected $_limit = array();

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

	/**
	 * order by
	 * @param $column
	 * @param null $direction
	 * @return $this
	 */
	public function order_by($column, $direction = NULL) {
		$this->_order_by[] = array($column, $direction);
		return $this;
	}

	/**
	 * limit
	 * @param   integer  $number  maximum results to return or NULL to reset
	 * @return  $this
	 */
	public function limit($number) {
		$this->_limit = $number;
		return $this;
	}

	/**
	 * compile where condition
	 * @param array $conditions
	 * @return string
	 */
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

}