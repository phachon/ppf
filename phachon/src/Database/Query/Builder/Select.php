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

	/**
	 * SELECT ...
	 * @var array|NULL
	 */
	protected $_select = [];

	/**
	 * SELECT DISTINCT ...
	 * @var bool
	 */
	protected $_distinct = FALSE;
	
	/**
	 * FROM table
	 * @var array
	 */
	protected $_table = '';

	/**
	 * GROUP BY ...
	 * @var array
	 */
	protected $_group_by = [];

	/**
	 * HAVING ...
	 * @var array
	 */
	protected $_having = [];
	
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
	 * select is distinct
	 * @param bool $isDistinct
	 * @return $this
	 */
	public function distinct($isDistinct = true) {
		$this->_distinct = $isDistinct;
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
	 * group by columns
	 * @param $columns
	 * @return $this
	 */
	public function group_by($columns){
		$columns = func_get_args();
		$this->_group_by = array_merge($this->_group_by, $columns);
		return $this;
	}

	/**
	 * having
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function having($column, $sign, $value) {
		$this->and_having($column, $sign, $value);
		return $this;
	}

	/**
	 * and_having
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function and_having($column, $sign, $value) {
		$this->_having[] = array ('AND' => array ($column, $sign, $value));
		return $this;
	}

	/**
	 * or_having
	 * @param string $column
	 * @param string $sign
	 * @param string $value
	 * @return $this
	 */
	public function or_having($column, $sign, $value) {
		$this->_having[] = array ('OR' => array ($column, $sign, $value));
		return $this;
	}

	/**
	 * open HAVING (...)
	 * @return $this
	 */
	public function having_open() {
		return $this->and_having_open();
	}

	/**
	 * open HAVING (...)
	 * @return $this
	 */
	public function and_having_open() {
		$this->_having[] = array('AND' => '(');
		return $this;
	}

	/**
	 * open OR (...)
	 * @return $this
	 */
	public function or_having_open() {
		$this->_having[] = array('OR' => '(');
		return $this;
	}

	/**
	 * close HAVING ( ... )
	 */
	public function having_close() {
		return $this->and_having_close();
	}

	/**
	 * close HAVING ( ... )
	 * @return $this
	 */
	public function and_having_close() {
		$this->_having[] = array('AND' => '(');
		return $this;
	}

	/**
	 * close HAVING ( ... )
	 * @return $this
	 */
	public function or_having_close() {
		$this->_having[] = array('OR' => '(');
		return $this;
	}

	/**
	 * complete sql
	 */
	public function complete() {

		$query = 'SELECT ';

		if($this->_distinct) {
			$query .= 'DISTINCT ';
		}

		if(empty($this->_select)) {
			$this->_select = array ('*');
		}

		$query .= implode(',', array_unique($this->_select));

		if(!$this->_table) {
			throw new Exception('sql from tables param is not to empty');
		}

		$query .= ' FROM ' . $this->_table;

		if(!empty($this->_where)) {
			$query .= ' WHERE ' . $this->_compileConditions($this->_where);
		}
		
		if(!empty($this->_group_by)) {
			$query .= ' GROUP BY '. $this->_compileGroupBy($this->_group_by);
		}
		
		if(!empty($this->_having)) {
			$query .= ' HAVING '. $this->_compileConditions($this->_having);
		}
		
		if(!empty($this->_order_by)) {
			$query .=  ' ORDER BY ' . $this->_compileOrderBy($this->_order_by);
		}
		
		if($this->_limit !== NULL) {
			$query .= ' LIMIT ' . $this->_limit;
		}
		
		if ($this->_offset !== NULL) {
			$query .= ' OFFSET '.$this->_offset;
		}

		$this->_sql = $query;

		return $this;
	}

}