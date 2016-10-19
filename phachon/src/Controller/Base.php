<?php
/**
 * Controller Base
 * @package   Phachon\Controller
 * @category  Controller
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace Phachon\Controller;

use Phachon\Http\Request as Request;
use Phachon\Http\Response as Response;
use Phachon\Service\Container as Container;

abstract class Base {

	/**
	 * 控制器方法
	 * @var string
	 */
	public $method = '';

	/**
	 * content
	 * @var string
	 */
	public $content = '';

	/**
	 * request
	 * @var
	 */
	public $request;

	/**
	 * reponse
	 * @var
	 */
	public $response;

	/**
	 * Base constructor.
	 * @param Request $request
	 * @param Response $response
	 */
	public function __construct(Request $request = NULL, Response $response = NULL) {
		$this->request = $request ? $request : Container::request();
		$this->response = $response ? $response : Container::response();
		$this->method = Container::router()->getMethod();
	}

	/**
	 * execute controller
	 * @return void
	 */
	public function execute() {
		$this->before();
		$this->{'action_'.$this->method}();
		$this->after();
	}

	/**
	 * before
	 * @return void
	 */
	public function before() {

	}

	/**
	 * after
	 * @return void
	 */
	public function after() {
		$this->response->body($this->content);
		$this->response->send();
	}

	/**
	 * redirect
	 * @param string $uri
	 * @param int $code
	 */
	public function redirect($uri = '', $code = 302) {

	}
}