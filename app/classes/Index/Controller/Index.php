<?php
/**
 * Index\Index Controller
 * @package   App\Index\Controller
 * @category  Controller
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license   MIT
 */

namespace App\Index\Controller;

use Phachon\Database\DB;
use Phachon\Controller\Base as BaseController;

class Index extends BaseController {

	public function action_index() {
		$reult = DB::select('*')
			->from('chat_user')
//			->where('username', '=', 'test')
			->and_where('user_id', '>', 0)
			->order_by('user_id', 'DESC')
			->offset(10)
			->limit(10)
			->execute('video');

	}
}