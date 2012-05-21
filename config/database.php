<?php defined('SYSPATH') OR die('No direct script access.');

$config = array();

$config['default'] = array(
	'type'			=> 'sql',		// string (e.g. sql, nosql, or ldap)
	'dialect'		=> 'mysql',     // string (e.g. db2, drizzle, firebird, mariadb, mssql, mysql, oracle, postgresql, or sqlite)
	'driver'        => 'standard',  // string (e.g. standard, improved, or pdo)
	'connection'    => array(
		'persistent'    => FALSE,       // boolean
		'hostname'      => 'localhost', // string
		'port'          => '',          // string
		'database'      => '',          // string
		'username'      => 'root',      // string
		'password'      => 'root',      // string
	),
	'caching'       => FALSE,       // boolean
	'charset'       => 'utf8',      // string
	'profiling'     => FALSE,       // boolean
	'table_prefix'  => '',          // string
);

return $config;
?>