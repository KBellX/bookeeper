<?php
include 'phpQuery.php';
$url = 'https://book.douban.com/subject/26906371';
phpquery::newDocumentFile($url);

$title      = pq('h1 span')->text();
    $content    = pq('.article');
    $img        = $content->find('.subject #mainpic a')->attr('href');
    $urlAuthor  = pq('.article .indent .subjectwrap .subject #info span:eq(0) a')->attr('href');
    $grade      = $content->find('.indent .subjectwrap #interest_sectl .rating_wrap .rating_self strong')->text();
    $numComment = $content->find('.indent .subjectwrap #interest_sectl .rating_wrap .rating_self .rating_right .rating_sum a span')->text();

$infoOld = pq('.article .indent .subjectwrap .subject #info')->text();
    $left    = $infoOld;
    $info    = [];
    for ($i = 10; $i >= 1; $i--) {
        //取最右边

        $right = strrchr($left, ':');
        $right = substr($right, 1);
        //留左边
        $num  = strrpos($left, ':');
        $left = substr_replace($left, '', $num);
        //去空格    去不了？？
        $right  = trim($right);
        $info[] = $right;
    }

var_dump($info);    