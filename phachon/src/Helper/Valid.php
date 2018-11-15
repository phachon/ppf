<?php
/**
 * Helper Valid
 * @package  Phachon\Helper
 * @category Valid
 * @author   phachon@163.com
 * @copyright (c) 2016-2017 phachon
 * @license MIT
 */

namespace Phachon\Helper;


class Valid {

	/**
	 * 验证 email 是否合法
	 * @param string $email 需要验证的邮箱地址
	 * @param boolean $real 是否需要验证邮箱地址存在
	 * @return boolean
	 * $real 为 false, 只验证邮箱格式
	 * $real 为 true,  验证邮箱 DNS 是否存在
	 */
	public static function email($email = '', $real = false) {

		$pattern = "/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/";

		if(! preg_match($pattern, $email)) {
			return false;
		}

		if($real) {
			if(filter_var($email) === false) {
				return false;
			}
			$domain = explode("@", $email);
			$hostname = array_pop($domain);
			if(checkdnsrr($hostname, "MX") === false) {
				return false;
			}
		}

		return true;
	}

	/**
	 * 验证是否是合法的 url
	 * @param string $url 待验证的 url
	 * @return boolean
	 */
	public static function url($url = '') {

		$pattern =
			// http https 验证
			'/^http[s]?:\/\/'.
			// IP形式的URL - 199.194.52.184
			'(([0-9]{1,3}\.){3}[0-9]{1,3}'.
			// 允许IP和DOMAIN（域名）
			'|'.
			// 三级域验证 - www.
			'([0-9a-z_!~*\'()-]+\.)*'.
			// 二级域验证
			'([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'.
			// 顶级域验证.com or .museum
			'[a-z]{2,6})'.
			// 端口- :80
			'(:[0-9]{1,4})?'.
			// 如果含有文件对文件部分进行校验
			'((\/\?)|'.
			'(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/';

		if(! preg_match($pattern, $url)) {
			return false;
		}

		return true;
	}

	/**
	 * 验证手机号是否合法
	 * @param $phone
	 * @return boolean
	 */
	public static function phone($phone) {
		if(preg_match('/^1[34578]{1}\d{9}$/', $phone)){
			return true;
		}else{
			return false;
		}
	}
}