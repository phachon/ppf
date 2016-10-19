<?php
/**
 * Database
 * @package   Phachon\Database
 * @category  Database
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Database;


abstract class Database {

	/**
	 * mysql connect
	 */
	const TYPE_MYSQL = 1;

	/**
	 * mysqli connect
	 */
	const TYPE_MYSQLI = 2;

	/**
	 * pdo connect
	 */
	const TYPE_PDO = 3;

	/**
	 * conn
	 * @var null
	 */
	protected $_conn = NULL;

	/**
	 * host
	 * @var string
	 */
	protected $_host = '127.0.0.1';

	/**
	 * port
	 * @var int
	 */
	protected $_port = 3306;

	/**
	 * user
	 * @var string
	 */
	protected $_user = '';

	/**
	 * password
	 * @var string
	 */
	protected $_password = '';

	/**
	 * charset
	 * @var string
	 */
	protected $_charset = '';

	/**
	 * database
	 * @var string
	 */
	protected $_database = '';

	/**
	 * type
	 * @var int
	 */
	protected $_type = 1;

	/**
	 * results
	 * @var null
	 */
	protected $_results = NULL;

	/**
	 * factory
	 * @param integer $type
	 * @return Database
	 */
	public static function factory($type) {

		if($type == self::TYPE_MYSQL) {
			return new Type\Mysql();
		}
		if($type == self::TYPE_MYSQLI) {
			return new Type\Mysqli();
		}
		if($type == self::TYPE_PDO) {
			return new Type\PDO();
		}

		return new Type\Mysql();
	}

	/**
	 * host
	 * @param string $host
	 * @return $this
	 */
	public function host($host = '') {
		$this->_host = $host;
		return $this;
	}

	/**
	 * port
	 * @param integer $port
	 * @return $this
	 */
	public function port($port = 0) {
		$this->_port = $port;
		return $this;
	}

	/**
	 * user
	 * @param  string $user
	 * @return object
	 */
	public function user($user = '') {
		$this->_user = $user;
		return $this;
	}

	/**
	 * password
	 * @param  string $password
	 * @return object
	 */
	public function password($password = '') {
		$this->_password = $password;
		return $this;
	}

	/**
	 * database
	 * @param  string $database
	 * @return object
	 */
	public function database($database = '') {
		$this->_database = $database;
		return $this;
	}

	/**
	 * charset
	 * @param  string $charset
	 * @return object
	 */
	public function charset($charset = '') {
		$this->_charset = $charset;
		return $this;
	}

	abstract public function connect();

	abstract public function query();

	abstract public function current();

	abstract public function getRow();

	abstract public function close();

}