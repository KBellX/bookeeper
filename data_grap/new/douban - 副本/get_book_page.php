<?php
/*
*抓书本页
*/
require 'curl.php';
require '../tools/phpquery.php';
for($i = 1220562; $i<=1220562; $i++){
	$i = 6390825;
	$url = 'https://book.douban.com/subject/'.$i.'/';
	$data = genCurl($url,$userAgent);
	if(substr($data,0,4) == 'Your'){
		echo '该id不是书';
		continue;
	}
	var_dump($data);
}
