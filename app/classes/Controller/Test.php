<?php
/**
 * Test Controller
 * @package   App\Controller
 * @category  Application controller
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace App\Controller;

use Phachon\Controller\Base as BaseController;

class Test extends BaseController {

	public function action_test() {
		var_dump($_GET);
		$this->content = 'test';
	}

	public function action_add() {
		var_dump($_GET);
		$this->content = 'add';
	}
}