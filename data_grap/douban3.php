<?php
include 'phpQuery.php';

//hot?p=6
$url = 'https://book.douban.com/subject/26853123';
phpquery::newDocumentFile($url);
// $info = pq('#content #info')->html();
// $info2 = pq('#content #info')->text(); 
// echo $info2;
// var_dump($info);
// // $reg = '/\<\/span\>(.*)\<br\>/U';
// // preg_match_all($reg, $info, $arr);
// // var_dump($arr[1]);

// $reg_a = '/\>(.*)\<\/span\>/U';
// preg_match_all($reg_a,$info,$arr_a);
// var_dump($arr_a);



