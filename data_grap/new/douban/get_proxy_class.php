<?php
//采集，跟新ip
header("Content-type:text/html;charset=utf-8");
require '../tools/QueryList/vendor/autoload.php';
require '../mysql.php';
require 'curl_class.php';
use QL\QueryList;

class get_proxy
{
    public function grabProxy($link)
    {
        $url  = 'http://www.xicidaili.com/';
        // $url = 'http://www.xicidaili.com/nn';
        $obj  = new imitateBrowser();
        $html = $obj->curl($url, 1);
        $data = QueryList::Query($html, array(
            'need' => array('.odd', 'html'),
        ))->data;
        for ($i = 0; $i < 50; $i++) {
            preg_match_all('/\>(.*)\</U', $data[$i]['need'], $out[$i]);
            $deal[$i] = $out[$i][1];
        }
        //对比入库
        for ($i = 0; $i < 50; $i++) {
            if ($deal[$i][4] == '高匿' or $deal[$i][4] == '透明') {
                //排除重复或不行的
                if ($this->check($link, $deal[$i][1])) {
                    continue 1;
                }
                $sql = "INSERT into proxy(ip,port) values('{$deal[$i][1]}','{$deal[$i][2]}') ";
                execute($link, $sql);
            } else if ($deal[$i][5] == '高匿' or $deal[$i][5] == '透明') {
                //排除重复或不行的
                if ($this->check($link, $deal[$i][2])) {
                    continue 1;
                }
                $sql = "INSERT into proxy(ip,port) values('{$deal[$i][2]}','{$deal[$i][3]}') ";
                execute($link, $sql);
            }
        }
        //删除不行的ip
        $this->delProxy($link);
        //记录采集时间
        $timeInsert = time();
        return $timeInsert;
    }
    //用ip
    public function useProxy($link)
    {
        $sql    = "SELECT ip,port FROM `proxy` WHERE data_state='1'  ORDER BY RAND() LIMIT 1";
        $result = execute($link, $sql);
        if ($row = $result->fetch_assoc()) {
            $proxy = $row['ip'] . ':' . $row['port'];
        } else {
            //抓ip 除了第一次基本不会用到
            $this->grabProxy($link);
            $proxy =  $this->useProxy($link);
            echo '没ip了，你妹,来自useProxy';
        }
        return $proxy;
    }
    //假删除ip
    public function updProxy($link, $proxy)
    {
        $proxyArr = explode(':', $proxy);
        $ip       = $proxyArr[0];
        $sql      = "UPDATE proxy SET data_state=0 WHERE ip='{$ip}'";
        execute($link, $sql);
    }
    //真删除
    private function delProxy($link)
    {
        $sql = "DELETE FROM proxy WHERE data_state=0";
        execute($link, $sql);
    }
    //计时更新
    public function updateTime($link, $timeInsert)
    {
        $timeNow = time();
        if ($timeNow - $timeInsert > 600) {
            $timeInsert = $this->grabProxy($link);
        }
        return $timeInsert;
    }
    //排除重复
    private function check($link, $ip)
    {
        $sql = "SELECT * FROM proxy WHERE ip='{$ip}'";
        if (execute($link, $sql)->fetch_assoc()) {
            return 1;
        }else{
        	return 0;
        }
    }
}

//使用示例

$get_api    = new get_proxy();
$get_api->grabProxy($link);

// $timeInsert = $obj->grabProxy($link);
// for () {
//     $timeInsert = update($link, $timeInsert);
//     $proxy = useProxy($link);
//     if (ip不行) {
//         $get_api->delProxy($link, $proxy);
//         continue 1;
//     }
// }
