<?php
/**
 * Base Exception
 * @package   Phachon\Exception
 * @category  exception
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Exception;

class Base extends \Exception {

	/**
	 * Exception constructor.
	 * @param string $message
	 * @param int $code
	 * @param \Exception|NULL $previous
	 */
	public function __construct($message = "", $code = 0, \Exception $previous = NULL) {
		parent::__construct($message, (int)$code, $previous);
	}
}