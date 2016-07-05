<?php
/**
 * Log write
 * @package   Phachon\Log
 * @category  log
 * @author    phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license
 */
namespace Phachon\Log;

use Monolog\Logger as MonoLogger;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Phachon\Interfaces\Logger\Log as PhachonLoggerInterface;

abstract class AbstractWrite implements PhachonLoggerInterface, PsrLoggerInterface {

	protected $_monoLog = NULL;

	public function __construct(MonoLogger $monoLogger) {
		$this->_monoLog = $monoLogger;
	}

	/**
	 * 紧急信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function emergency($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 警惕信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function alert($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 严重信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function critical($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 错误
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function error($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 警告信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function warning($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 注意信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function notice($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 提示信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function info($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 调试信息
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function debug($message, array $context = array()) {
		return $this->_writer(__FUNCTION__, $message, $context);
	}

	/**
	 * 普通日志信息
	 * @param integer $level
	 * @param string $message
	 * @param array $context
	 * @return null
	 */
	public function log($level, $message, array $context = array()) {
		return $this->_writer($level, $message, $context);
	}

	/**
	 * 写入
	 * @param $level
	 * @param $message
	 * @param array $context
	 * @return null
	 */
	public function write($level, $message, array $context = array ()) {
		return $this->_writer($level, $message, $context);
	}

	/**
	 * 开始写入
	 * @param $level
	 * @param $message
	 * @param array $context
	 */
	protected function _writer($level, $message, array $context = array ()) {
		$this->_pushHandler();
		$this->_monoLog->{$level}($message, $context);
	}

	abstract protected function _pushHandler();
}