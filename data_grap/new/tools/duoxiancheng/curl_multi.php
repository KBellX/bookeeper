<?php
/*
多线程网上例子
 */
require 'curl_class.php';
require '../QueryList/vendor/autoload.php';
use QL\QueryList;

$urls = array(
    'douban'   => 'https://book.douban.com/subject/26704403/',
    'zhongguo' => 'http://www.bookschina.com/1046751.htm',
); 
// 设置要抓取的页面URL
$mh = curl_multi_init();
foreach ($urls as $i => $url) {
    $conn[$i] = curl_init($url);
    curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
    curl_setopt($conn[$i], CURLOPT_HEADER, 0);
    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, true); // 设置不将爬取代码写到浏览器，而是转化为字符串
    curl_setopt($conn[$i], CURLOPT_SSL_VERIFYPEER, false); //访问https
    curl_setopt($conn[$i], CURLOPT_SSL_VERIFYHOST, false); //访问https
    // curl_setopt($conn[$i], CURLOPT_FILE, $st); // 设置将爬取的代码写入文件
    curl_multi_add_handle($mh, $conn[$i]);
} // 初始化

do {
    curl_multi_exec($mh, $active);
} while ($active); // 执行
//数据处理
foreach ($urls as $i => $url) {
    $data = curl_multi_getcontent($conn[$i]); // 获得爬取的代码字符串
    $aa   = QueryList::Query($data, array(
        'need' => array('#info', 'text'),
    ))->data;
}
// 结束清理
foreach ($urls as $i => $url) {
    curl_multi_remove_handle($mh, $conn[$i]);
    curl_close($conn[$i]);
}
curl_multi_close($mh);
fclose($st);

// //防止死循环耗死cpu 这段是根据网上的写法
// do {
//     $mrc = curl_multi_exec($mh, $active); //当无数据，active=true
// } while ($mrc == CURLM_CALL_MULTI_PERFORM); //当正在接受数据时
// while ($active and $mrc == CURLM_OK) {//当无数据时或请求暂停时，active=true
//     if (curl_multi_select($mh) != -1) {
//         do {
//             $mrc = curl_multi_exec($mh, $active);
//         } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//     }
// }
