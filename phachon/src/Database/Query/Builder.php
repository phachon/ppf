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


use Phachon\Database\Exception;
use Phachon\Database\Query;
use Phachon\Helper\Arr;
use Phachon\Helper\Str;

abstract class Builder {

	protected $_sql = '';

	protected $_opsMapping = [
		'=' => 'IS',
		'!=' => 'IS NOT',
		'<>' => 'IS NOT',
	];

	/**
	 * builder select handle
	 * @param string $param
	 * @return object Builder\Select
	 */
	public static function select($param = NULL) {
		return new Builder\Select(func_get_args());
	}

	/**
	 * compile where condition
	 * @param array $conditions
	 * @return string
	 */
	protected function _compileConditions(array $conditions) {
		echo "<pre>";
		var_dump($conditions);
//		exit();
		$whereSql = '';
		foreach ($conditions as $condition) {
			foreach ($condition as $sign => $values) {

				if($whereSql !== '') {
					$whereSql .= ' '.$sign.' ';
				}
				if($values == "(") {
					$whereSql .= '(';
				}
				if($values == ")") {
					$whereSql .= ')';
				}

				list($column, $op, $value) = $values;

				$whereSql .= trim($column.' '.$op.' '.$value);

				echo $whereSql."<br>";
//				if($values === '(') {
//					if (!empty($whereSql)) {
//						$whereSql .= ' '.$sign.' ';
//					}
//					$whereSql .= '(';
//				} elseif($values === ')')  {
//					$whereSql .= '(';
//				}
//
//				list($column, $op, $value) = $values;
//
//				if(!is_string($column)) {
//					throw new Exception("sql condition $column must be string!");
//				}
//				if($value === NULL) {
//					$op = Arr::get($this->_opsMapping, $op, $op);
//				}
//
//				$op = strtoupper($op);
//
//				if($op == "IN") {
//					if(!is_array($value)) {
//						throw new Exception('sql condition IN values must be array!');
//					}
//
//					$whereSql .= '(' .implode($value, ','). ')';
//				}
//				if($op == "BETWEEN") {
//					if(!is_array($value)) {
//						throw new Exception('sql condition BETWEEN values must array!');
//					}
//					list($min, $max) = $value;
//
//					$whereSql .= $min. " AND " .$max;
//				}

//				$whereSql .= trim($column.' '.$op.' '.$value);
			}
		}

		return $whereSql;
	}

	/**
	 * compile group by condition
	 * @param array $conditions
	 * @return string
	 */
	public function _compileGroupBy(array $conditions) {
		return implode($conditions, ",");
	}
	
	/**
	 * compile where condition
	 * @param array $conditions
	 * @return string
	 * @throws Exception
	 */
	protected function _compileOrderBy(array $conditions) {

		$compileOrderBy = [];
		foreach ($conditions as $column => $direction) {
			if(!$direction) {
				throw new Exception('sql order_by direction not to be null!');
			}
			if(strtolower($direction) != 'desc' && strtolower($direction) != 'asc') {
				throw new Exception('sql order_by direction not support '.$direction.', must DESC or ASC !');
			}

			$orderBy = $column. ' ' .strtoupper($direction);
			$compileOrderBy[] = $orderBy;
		}
		
		return implode($compileOrderBy, ",");
	}

	/**
	 * compile having condition
	 * @param array $condition
	 */
	protected function _compileHaving(array $condition) {

	}

	/**
	 * return complete sql
	 * @return string
	 */
	public function getSql() {
		return $this->_sql;
	}

	/**
	 * echo sql
	 * @return string
	 */
	public function __toString() {
		return $this->_sql;
	}

	abstract public function complete();
}