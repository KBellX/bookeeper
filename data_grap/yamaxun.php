<?php
include 'phpQuery.php';
phpquery::newDocumentFile('https://www.amazon.cn/b/?_encoding=UTF8&bbn=658390051&ie=UTF8&node=1365667071&ref_=pc_cxrd_658393051_sub_13_image&pf_rd_p=a0ac6289-bb7f-4e77-9c95-9b7c51d02f78&pf_rd_s=merchandised-search-6&pf_rd_t=101&pf_rd_i=658393051&pf_rd_m=A1AJ19PSB66TGU&pf_rd_r=7J67HWB7T1JWAGAAN0SR&pf_rd_r=7J67HWB7T1JWAGAAN0SR&pf_rd_p=a0ac6289-bb7f-4e77-9c95-9b7c51d02f78');

$books = pq('.a-fixed-left-grid-inner');	// 这里pq选的是数组
foreach($books as $li){
	//左边
	$book = pq($li);	//这里pq选的是变量
	$urlBook = $book->find('.a-col-left .a-row .a-column a')->attr('href');
	$img = $book->find('.a-col-left .a-row .a-column a img')->attr('src');
	// $infoPrice = $book->find('.a-col-left .a-row .a-column i')->css('background-image');		//满减抓不到
	//右边
	$title = $book->find('.a-col-right .a-row .a-row a h2')->text();
	$date = $book->find('.a-col-right .a-row .a-row span:eq(2)')->text();
	$author = $book->find('.a-col-right .a-row .a-row span:eq(4)')->text();
	//价格，购买方面信息
	phpquery::newDocumentFile($urlBook);
	$kinds = pq('.swatchElement');
	foreach($kinds as $kind){
		$kind = pq($kind);
		$kindle = $kind->find('.a-list-item .a-button-inner a span')->text();
		echo $kindle;
		break;
	}
	// echo $urlBook;
	break;
}
