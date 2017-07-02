<?php
/*
抓豆瓣 https://book.douban.com/subject/1866161/
这种页面
*/
// require '../tools/phpquery.php';
require 'get_proxy_class.php';
use QL\QueryList;

function randFloat($min=0, $max=1){
    return $min + mt_rand()/mt_getrandmax() * ($max-$min);
}

function dealInsert($link, $obj)
{
    $obj = mysqli_real_escape_string($link, $obj);
    $obj = "'" . $obj . "'";
    return $obj;
}
//开始时间
$timeStart = time();
$numStart  = 1002166;
$numEnd    = 1003000;

$myIp       = 0;
$get_api    = new get_proxy();
$timeInsert = $get_api->grabProxy($link);
$ch         = new imitateBrowser();
for ($i = $numStart; $i <= $numEnd; $i++) {
    $url = 'https://book.douban.com/subject/' . $i . '/';
    if ($myIp) {
        $htmla = $ch->curl($url, 1);
        sleep(randFloat(1,2));
    } else {
        echo 'ip代理了';
        $timeInsert = $get_api->updateTime($link, $timeInsert);
        //获取ip
        $proxy = $get_api->useProxy($link);
        // echo '书id：' . $i . '哈' . $proxy . '<br />';
        $htmla = $ch->curl($url, 1, $proxy);
    }
    // echo '<pre>';
    // print_r($htmla);
    if (substr($htmla, 0, 4) == 'Your') {
        echo '该id不是书';
        continue;
    }
    //处理data
    $rules = array(
        'title'            => array('#wrapper h1', 'text'),
        'info'             => array('#info', 'text'),
        'rating_average'   => array('.rating_self strong', 'text'),
        'rating_numRaters' => array('.rating_self .rating_right .rating_sum a span', 'text'),
    );
    @$data = QueryList::Query($htmla, $rules)->data;
    if(empty($data)){
        echo '这个ip不行';
        $i = $i - 1;
        continue 1;
    }
    // echo '<pre>';
    // print_r($data);
    if (!isset($data[0]['rating_numRaters'])) {
        $data[0]['rating_numRaters'] = 0;
    }
    if (empty($data[0]['rating_average'])) {
        $data[0]['rating_average'] = 0;
    }
    $data[0]['douban_id'] = $i;
    // echo '<pre>';
    // print_r($data[0]);
    //入库
    $fields = ['title', 'info', 'rating_average', 'rating_numRaters', 'douban_id'];
    $fields = implode(',', $fields);
    $values = dealInsert($link, $data[0]['title']) . ',' . dealInsert($link, $data[0]['info']) . ',' . dealInsert($link, $data[0]['rating_average']) . ',' . dealInsert($link, $data[0]['rating_numRaters']) . ',' . dealInsert($link, $data[0]['douban_id']);
    // echo $values;
    $sql = "INSERT INTO doubao_bookpage($fields) VALUES($values)";
    execute($link, $sql);
}

//结束时间
$timeEnd = time();
echo '用时:' . date('H:i:s', $timeEnd - $timeStart) . '<br />';
echo '共抓到 ' . ($numEnd - $numStart + 1) . ' 条数据';
