<?php
/*
单个网站多线程处理
 */
// header("Content-type: text/html; charset=gb2312");
require 'curl_class.php';
require '../QueryList/vendor/autoload.php';

//使用示例
// class multi_douban extends curl_multi_single
// {
//     public function dealData($conns, $link)
//     {
//         // foreach ($conns as $conn) {
//         //     $html = curl_multi_getcontent($conn); // 获得爬取的代码字符串
//         //     $data = QueryList::Query($html, array(
//         //         'title' => array('.this_book h1', 'text'),
//         //     ))->data;
//         //     //处理
//         // }
//     }
//     //可自定处理函数
// }

//多网站多线程使用示例
//给url时弄成单数为A网站，双数为B网站
// class multi_douban extends curl_multi_single
// {
//     public function dealData($conns, $link)
//     {
        // foreach ($conns as $key=>$conn) {
        //     $html = curl_multi_getcontent($conn); // 获得爬取的代码字符串
        //     if($key%2 == 0){
        //         new dealDouban();
        //     }else{
        //         new dealzhongguo();
        //     }
        // }
//     }
// }

// $douban = new multi_douban($urls,$link);
a

class curl_multi_single
{
    public $urls = array();
    public function __construct($urls, $link)
    {
        $mh = curl_multi_init();
        //curl设置
        $cur   = new imitateBrowser();
        $conns = $this->setCurl($urls, $cur);
        $this->addHandle($mh, $conns);
        // 执行
        do {
            curl_multi_exec($mh, $active);
        } while ($active);
        // 数据处理
        $this->dealData($conns, $link);
        // 结束清理
        $this->endMulti($mh, $conns);
    }
    private function addHandle($mh, $conns)
    {
        foreach ($conns as $conn) {
            curl_multi_add_handle($mh, $conn);
        }
    }
    private function endMulti($mh, $conns)
    {
        foreach ($conns as $conn) {
            curl_multi_remove_handle($mh, $conn);
            curl_close($conn);
        }
        curl_multi_close($mh);
    }
    private function setCurl($urls, $cur)
    {
        foreach ($urls as $url) {
            $conns[] = $cur->curl($url, 1, 0, 1);
        }
        return $conns;
    }
    protected function dealData($conns, $link)
    {
        // foreach ($conns as $conn) {
        //     $html = curl_multi_getcontent($conn); // 获得爬取的代码字符串
        //     $data = QueryList::Query($html, array(
        //         'title' => array('.this_book h1', 'text'),
        //     ))->data;
        //     //处理
        // }
    }
}

$a = new curl_multi_single();
$a->setCurl();