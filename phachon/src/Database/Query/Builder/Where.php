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

	protected $_where = [];

	protected $_order_by = [];

	protected $_limit = 0;
	
	protected $_offset = 0;

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
		$this->_where[] = array ('AND' => array ($column, $sign, $value));
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
		$this->_where[] = array ('OR' => array ($column, $sign, $value));
		return $this;
	}

	/**
	 * open WHERE (...)
	 * @return $this
	 */
	public function where_open() {
		return $this->and_where_open();
	}

	/**
	 * open WHERE (...)
	 * @return $this
	 */
	public function and_where_open() {
		$this->_where[] = array('AND' => '(');
		return $this;
	}

	/**
	 * open OR (...)
	 * @return $this
	 */
	public function or_where_open() {
		$this->_where[] = array('OR' => '(');
		return $this;
	}

	/**
	 * close WHERE ( ... )
	 */
	public function where_close() {
		return $this->and_where_close();
	}

	/**
	 * close WHERE ( ... )
	 * @return $this
	 */
	public function and_where_close() {
		$this->_where[] = array('AND' => ')');
		return $this;
	}

	/**
	 * close WHERE ( ... )
	 * @return $this
	 */
	public function or_where_close() {
		$this->_where[] = array('OR' => ')');
		return $this;
	}

	/**
	 * limit
	 * @param string $limit
	 * @return $this
	 */
	public function limit($limit) {
		$this->_limit = $limit;
		return $this;
	}

	/**
	 * offset
	 * @param string $offset
	 * @return $this;
	 */
	public function offset($offset) {
		$this->_offset = $offset;
		return $this;
	}

	/**
	 * order_by
	 * @param mixed string || array
	 * @param null $direction
	 * @return $this
	 */
	public function order_by($column, $direction = NULL) {
		if(is_array($column)) {
			$this->_order_by = $column;
		}else {
			$this->_order_by = array($column => $direction);
		}
		return $this;
	}

}