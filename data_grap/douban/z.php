<?php
//querlist处理区
require '../QueryList/vendor/autoload.php';
/*include("demo2.php");*/
use QL\QueryList;
// for ($i = 25862578; $i <= 25862578; $i++) {
    $url  = 'https://book.douban.com/subject/25862578/?qq-pf-to=pcqq.c2c';
    // $url = 'https://book.douban.com/subject/'.$i.'/';
    $html = file_get_contents($url); //得到url的html代码
    $data = QueryList::Query($html, array(
        'need'      => array('[class="subject clearfix"]', 'html'),
        'title'     => array('#wrapper h1 span', 'text'),
        'autor'     => array('#info span:eq(0) a', 'text'),
        'img'       => array('#mainpic .nbg img', 'src'),
        'translate' => array('#info a:eq(1)', 'text'),
        'number'    => array('[class="ll rating_num "]', 'text'),
        'autorlife' => array('.related_info .indent:eq(0) .intro', 'html'),
        'bookintro' => array('[class="intro"]:eq(1)', 'html'),
    ))->data; //将存在我们需要信息的那一块截下来
    $string = $data[0]['need']; //选中那一块
    $str    = addslashes($string); //转义为正则做准备
    preg_match_all('/\<span(.*)\<br\>/U', $str, $out); //初步取出我们需要的信息
    //处理数据
    $obj       = $out[1];
    $autorlife = $data[0]['autorlife'];
    $bookintro = $data[0]['bookintro'];
//准备步骤
    $obj1 = str_replace('class=\"pl\">', '', $obj); //处理数据1
    $obj2 = str_replace('</span>', '', $obj1); //处理数据2
    $obj3 = preg_replace("/<a[^>]*>/", "", $obj2); //处理数据3
    $obj4 = preg_replace("/<\/a>/", "", $obj3);
//处理简介与作者介绍
    $obj5 = str_replace(' ', '', $autorlife);
    $obj6 = str_replace(' ', '', $bookintro);
/*echo "<pre>";
print_r($obj4);
 *///整理数据
    $title     = '书名:' . $data[0]['title'];
    $autor     = '作者:' . $data[0]['autor'];
    $img       = '图片:' . $data[0]['img'];
    $translate = '译者:' . $data[0]['translate'];
    $number    = '评分:' . $data[0]['number'];
    $autorlife = '介绍:' . $obj5;
    $bookintro = '简介:' . $obj6;
    array_unshift($obj4, "$title", "$autor", "$img", "$translate", "$number", "$autorlife", "$bookintro");
    $obj4 = str_replace(' ', '', $obj4); //去除数组中的空格
    $b    = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    for ($i = 0; $i <= 14; $i++) {
        $test = explode(':', $obj4[$i]);
        if ($test[0] == '书名') {
            $b[0] = $test[1];
        } else if ($test[0] == '作者') {
            $b[1] = $test[1];
        } else if ($test[0] == '图片') {
            $b[2] = $test[2];
        } else if ($test[0] == '译者') {
            $b[3] = $test[1];
        } else if ($test[0] == '评分') {
            $b[4] = $test[1];
        } else if ($test[0] == '介绍') {
            $b[5] = $test[1];
        } else if ($test[0] == '简介') {
            $b[6] = $test[1];
        } else if ($test[0] == '出版社') {
            $b[7] = $test[1];
        } else if ($test[0] == '原作名') {
            $b[8] = $test[1];
        } else if ($test[0] == '出版年') {
            $b[9] = $test[1];
        } else if ($test[0] == '页数') {
            $b[10] = $test[1];
        } else if ($test[0] == '定价') {
            $b[11] = $test[1];
        } else if ($test[0] == '装帧') {
            $b[12] = $test[1];
        } else if ($test[0] == '丛书') {
            $b[13] = $test[1];
        } else if ($test[0] == 'ISBN') {
            $b[14] = $test[1];
        }
    }
    echo "<pre>";
    print_r($b);
// }
