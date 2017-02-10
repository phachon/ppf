<?php
/**
 * database config
 * @author: panchao
 * Time: 16:53
 */

return array (

	'video' => array
	(
		'type'       => 'PDO',
		'host'       => '127.0.0.1',
		'port'       => '3306',
		'database'     => 'phachat',
		'user'   => 'root',
		'password'   => '123456',
		'persistent' => FALSE,
		'table_prefix' => 'approve_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);