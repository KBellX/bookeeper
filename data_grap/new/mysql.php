<?php
define('HOST','localhost');
define('USENAME','root');
define('PASSWORD','');
define('DATABASE','book');
define('PORT','3306');
$link = mysqli_connect(HOST,USENAME,PASSWORD,DATABASE,PORT);

//不能写成utf-8!!!
mysqli_set_charset($link,"utf8");

function execute($link,$sql){
	$result=mysqli_query($link,$sql);
	if(mysqli_errno($link)){
		exit(mysqli_error($link));		
	}
	return $result;
}