<?php
include '../phpQuery.php';
for ($i = 1100000,$time = 1; $i <= 1100000; $i++,$time++) {
	if($time%10 == 0){
		sleep(rand(15,25));
	}
    $url = "https://api.douban.com/v2/book/{$i}";
    $book = phpquery::newDocumentFile($url);
	$book = json_decode($book,true);
	echo '<pre>';
	print_r($book['author']);
	echo '<h1>哈哈</h1>';
	//作者处理

	// if(){
	// 	$author = '';
	// 	foreach($book['author'] as $author){
	// 		$strAuthor .= $author; 
	// 	}
	// 	echo $strAuthor;
	// }else{
	// 	$author = $book['author'];
	// }
	
	// $info = array(
	// 	$book['subtitle'],$book['']
	// 	);
	// foreach($book as $one){
	// 	foreach($one as $two){
	// 		echo '<pre>';
	// 		print_r($two);
	// 		echo '<h3>呵呵</h2>';
	// 	}
	// 	echo '<pre>';
	// 	print_r($one);
	// 	break;
	// }
	// echo '<h2>嘻嘻</h2>';
	// break;
}


