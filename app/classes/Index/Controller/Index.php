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
use Phachon\Database\Query;
use Phachon\Database\Query\Builder;

class Index extends BaseController {

	public function action_index() {

		$query = Query\Builder::select('name','password', 'hu')
			->distinct()
			->from('chat_user', 'chat_name')
			->where_open()
				->and_where('username', '=', 'test')
				->and_where('user_id', '>', 0)
				->or_where('user_id', '>', 110)
			->where_close()
			->complete()
			->getSql();
		
		echo $query;
//		var_dump($query);

	}
}