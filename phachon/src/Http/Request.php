<?php
/**
 * Http Response
 * @package   Phachon\Http
 * @category  Http
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Http;

use Phachon\Interfaces\Http\Request as PhachonRequestInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;


class Request extends SymfonyRequest implements PhachonRequestInterface {

	/**
	 * request instance
	 * @var null
	 */
	protected static $_instance = NULL;

	/**
	 * symfony request instance
	 * @var null|SymfonyRequest
	 */
	protected $_symfonyRequestInstance = NULL;

	/**
	 * create request instance
	 */
	public static function createRequest() {
		return self::createFromGlobals();
	}

	/**
	 * return instance
	 * @return $this
	 */
	public function instance() {
		return $this;
	}

	/**
	 * 获取 http method
	 * @return string
	 */
	public function method() {
		return $this->getMethod();
	}
}