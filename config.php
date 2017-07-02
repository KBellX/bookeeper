<?php
//数据库配置
$config['dbconfig'] = [
    'dbtype' => 'mysql_i',
    'info'   => array('host' => 'localhost', 'user' => 'root', 'pwd' => '', 'db_name' => 'bookeeper','characterset' => 'utf8'),
];
//控制器
$config['allowControllers'] = [
	'index','account','book','stacks','search','err','news'
];

// 常量
define('CURRENTURL',$_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'],true);

// 关闭报错提示
// error_reporting(0);
