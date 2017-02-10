<?php
/**
 * Database Query Builder Select
 * @package   Phachon\Database\Query\Builder
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database\Query\Builder;

use Phachon\Database\Exception;
use Phachon\Database\Query\Builder;

class Select extends Where {

	protected $_select = array();

	protected $_offset = NULL;

	protected $_group_by = array();

	/**
	 * Select constructor.
	 * @param array|NULL $columns columns list
	 */
	public function __construct(array $columns) {
		if(! empty($columns)) {
			$this->_select = $columns;
		}
	}

	/**
	 * select columns
	 * @param null $columns
	 * @return $this
	 */
	public function select($columns = NULL) {
		$columns = func_get_args();
		$this->_select = array_merge($this->_select, $columns);
		return $this;
	}

	/**
	 * select from table
	 * @param string $table table name
	 * @return $this
	 */
	public function from($table) {
		$this->_table = $table;
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
	 * @param string $column
	 * @param null $direction
	 * @return $this
	 */
	public function order_by($column, $direction = NULL) {
		$this->_order_by = array($column, $direction);
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
	 * complete sql
	 */
	public function complete() {

		$query = 'SELECT ';

		if(empty($this->_select)) {
			// select *
			$this->_select = array ('*');
		}

		// select columns ,
		$query .= implode(',', array_unique($this->_select));

		if(!$this->_table) {
			throw new Exception('database table is not empty');
		}
		if($this->_table) {
			$query .= ' FROM ' . $this->_table;
		}
		if(!empty($this->_where)) {
			// add where conditions
			$query .= ' WHERE' . $this->_compileWhere($this->_where);
			echo $query;
			exit();
		}
		if(!empty($this->_order_by)) {
			// add order_by conditions
			$query .=  " ORDER BY '{$this->_order_by[0]}' {$this->_order_by[1]}";
		}
		if($this->_limit !== NULL) {
			// add limit conditions
			$query .= ' LIMIT ' . $this->_limit;
		}
		if ($this->_offset !== NULL) {
			// add offset conditions
			$query .= ' OFFSET '.$this->_offset;
		}

		$this->_sql = $query;
	}

}