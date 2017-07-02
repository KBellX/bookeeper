<?php
/*
抓豆瓣 https://book.douban.com/subject/1866161/
这种页面
*/
require 'curl.php';
require '../tools/phpquery.php';
for($i = 1220562; $i<=1220562; $i++){
	$i = 6390825;
	$url = 'https://book.douban.com/subject/'.$i.'/';
	echo $url;
	// die;
	$data = genCurl($url);

	// if(substr($data,0,4) == 'Your'){
	// 	echo '该id不是书';
	// 	// continue;

	// }
	echo $data;
	// var_dump($data);
}
