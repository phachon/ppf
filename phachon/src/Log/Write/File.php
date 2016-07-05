<?php
/**
 * write log to file
 * @package   Phachon\Log\W
 * @category  log
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */

namespace Phachon\Log\Write;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Phachon\Log\AbstractWrite as PhachonLogWrite;

class File extends PhachonLogWrite {

	public function __construct(MonoLogger $monoLogger) {
		parent::__construct($monoLogger);
	}

	/**
	 * push file handle
	 */
	protected function _pushHandler() {
		$this->_monoLog->pushHandler(new StreamHandler(LOG_DIR.'/my_app.log', MonoLogger::DEBUG));
		$this->_monoLog->pushHandler(new FirePHPHandler());
	}
}