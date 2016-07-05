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

use Phachon\Interfaces\Http\Response as PhachonResponseInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response extends SymfonyResponse implements PhachonResponseInterface {

	/**
	 * 创建一个 Response 对象
	 * @return Response
	 */
	public static function createResponse() {
		return new Response();
	}
	/**
	 * set body
	 * @param $body
	 * @return SymfonyResponse
	 */
	public function body($body) {
		$this->setContent($body);
	}

	/**
	 * set headers
	 * @param $header
	 * @param $content
	 */
	public function headers($header, $content) {
		$this->headers->set($header, $content);
	}

	/**
	 * set code
	 * @param $code
	 */
	public function httpCode($code) {
		$this->setStatusCode($code);
	}
}