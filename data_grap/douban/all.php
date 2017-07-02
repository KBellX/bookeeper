<?php
include '../phpQuery.php';

//内容介绍等
// $url = 'https://book.douban.com/subject/25862578/';
// phpquery::newDocumentFile($url);

// $introBook = pq('[class="intro"]:eq(0)')->text();
// $intrAuthor = pq('[class="intro"]:eq(1)')->text();

// $dir = pq('[id="dir_25862578_full"]')->text();
// echo $dir;
// // dir_25862578_short


//标签大全
phpquery::newDocumentFile('https://book.douban.com/tag/');
$tag = pq('[class="tagCol"] a')->attr('href');
echo $tag;
