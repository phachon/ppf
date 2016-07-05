<?php
/**
 * Log Factory
 * @package   Phachon\Log
 * @category  Log
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Log;


class Factory {

	const SEND_FILE = 1;
	const SEND_DATABASE = 2;
	const SEND_REDIS = 3;
	const SEND_MONGODB = 4;
	const SEND_EMAIL = 5;

	public function __construct($type) {
		
	}
}