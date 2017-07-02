<?php
require 'curl.php';
require '../mysql.php';
$url = 'https://api.douban.com/v2/book/1000002';
$data  = genCurl($url, $userAgent);
$sql = "INSERT INTO json(json) VALUES('{$data}')";
echo $sql;
// execute($link,$sql);