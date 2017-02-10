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

	abstract public function complete();
}