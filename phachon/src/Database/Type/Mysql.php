<?php
/**
 * Database Mysql Type
 * @package   Phachon\Database\Type
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database\Type;

use Phachon\Database\Database;
use Phachon\Database\Exception;

class Mysql extends Database {

	public function connect() {

		$this->_conn = @mysql_connect($this->_host. ":" .$this->_port, $this->_user, $this->_password);

		if(!$this->_conn){
			throw new Exception("Mysql connection error:code: ".mysql_errno()."; content:".mysql_error());
		}

		if(!mysql_select_db($this->_database, $this->_conn)) {
			throw new Exception("Mysql database select error");
		}

		$this->query("set names $this->_charset");

		return $this;
	}

	public function query($sql = '') {

		$this->_results = mysql_query($sql, $this->_conn);
		if(!$this->_results){
			throw new Exception("Mysql execute sql error:code:".mysql_errno()."; content:".mysql_error(), 1);
		}
		return $this->_results;
	}

	public function current()
	{
		// TODO: Implement current() method.
	}

	public function getRow()
	{
		// TODO: Implement getRow() method.
	}

	/**
	 * close conn
	 */
	public function close() {
		if($this->_conn) {
			mysql_close ($this->_conn);
		}
	}

	/**
	 * 析构
	 */
	public function __destruct() {
		$this->close();
	}
}