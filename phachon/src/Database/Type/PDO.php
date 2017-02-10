<?php
/**
 * Database Pdo Type
 * @package   Phachon\Database\Type
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database\Type;

use Phachon\Database\Database;
use Phachon\Database\Exception;

class Pdo extends Database {

	/**
	 * pdo
	 * @var null
	 */
	protected $_pdo = NULL;

	/**
	 * connect
	 * @return $this
	 */
	public function connect() {

		$dns = "mysql:dbname=$this->_database;host=$this->_host;port=$this->_port";
		try {
			$this->_pdo = new \PDO($dns, $this->_user, $this->_password, array(\PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES $this->_charset"));
			$this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			throw new \PDOException("Mysql connection error:" . $e->getMessage());
		}

		return $this;
	}

	/**
	 * query
	 * @param string $sql
	 * @return null
	 * @throws \PDOException
	 */
	public function query($sql = '') {

		try {
			$this->_results = $this->_pdo->prepare($sql);
			$this->_results->execute();
			if(! $this->_results) {
				throw new \PDOException("Mysql execute sql error:coed :" . \PDO::errorCode . "content: " . \PDO::errorInfo);
			}
		} catch (\PDOException  $e) {
			throw new \PDOException("Mysql execute sql error:" . $e->getMessage());
		}
		return $this->_results;
	}

	public function current() {
		return $this->_results ? $this->_results->fetch(\PDO::FETCH_ASSOC) : FALSE;
	}

	public function getRow() {
		return $this->_results ? $this->_results->rowCount() : FALSE;
	}

	public function close() {
		if($this->_pdo) {
			$this->_pdo = NULL;
		}
	}

	/**
	 * 析构
	 */
	public function __destruct() {
		$this->close();
	}

}