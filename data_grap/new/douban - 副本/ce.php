<?php
header("Content-type:text/html;charset=utf-8");
require '../tools/QueryList/vendor/autoload.php';
require 'curl.php';
require '../mysql.php';
use QL\QueryList;
//抓ip
function grabProxy($link)
{
    $url  = 'http://www.xicidaili.com/';
    $html = genCurl($url, 1);
    $data = QueryList::Query($html, array(
        'need' => array('.odd', 'html'),
    ))->data;
    for ($i = 0; $i < 50; $i++) {
        preg_match_all('/\>(.*)\</U', $data[$i]['need'], $out[$i]);
        $deal[$i] = $out[$i][1];
    }
    for ($i = 0; $i < 50; $i++) {
        if ($deal[$i][4] == '高匿') {
            $sql = "INSERT into proxy(ip,port) values('{$deal[$i][1]}','{$deal[$i][2]}') ";
            execute($link, $sql);
        } else if ($deal[$i][5] == '高匿') {
            $sql = "INSERT into proxy(ip,port) values('{$deal[$i][2]}','{$deal[$i][3]}') ";
            execute($link, $sql);
        }
    }

}
//删ip
function delProxy($link)
{
    $sql = "UPDATE proxy set data_state='0' WHERE adddate(create_at,INTERVAL 60 SECOND)<curtime()";
    execute($link, $sql);
    $sql = "DELETE FROM proxy WHERE data_state='0'";
    execute($link, $sql);
}
//用ip
function useProxy($link)
{
    $sql    = "SELECT ip,port FROM `proxy` WHERE  adddate(create_at,INTERVAL 60 SECOND)>curtime() AND data_state='1'  ORDER BY RAND() LIMIT 1";
    $result = execute($link, $sql);
    if ($row = $result->fetch_assoc()) {
        $proxy = $row['ip'] . ':' . $row['port'];
    } else {
        //抓ip
        grabProxy($link);
        //倒计时10分钟删ip
        delProxy($link);
        $proxy = useProxy($link);
    }
    return $proxy;
}
// $proxy = useProxy($link,$userAgent);
// echo '<pre>';
// print_r($proxy);
