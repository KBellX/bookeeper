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
        for ($n = 1; $n <= 4; $n++) {
            $url = 'http://www.xicidaili.com/nn/'.$n;
            // $url = 'http://www.xicidaili.com/nn';
            // $url = 'http://www.xicidaili.com/';
            $obj  = new imitateBrowser();
            $html = $obj->curl($url, 1);
            $data = QueryList::Query($html, array(
                'need' => array('tr', 'html'),
            ))->data;
            for ($i = 0; $i <= 100; $i++) {
                preg_match_all('/\>(.*)\</U', $data[$i]['need'], $out[$i]);
                $deal[$i] = $out[$i][1];
            }
            // // echo '<pre>';
            // // print_r($deal);
            // //对比入库
            for ($i = 0; $i <= 100; $i++) {
                if ($deal[$i][3] == '高匿') {
                    // //排除重复或不行的
                    if ($this->checkChongFu($link, $deal[$i][1])) {
                        continue 1;
                    }
                    $sql = "INSERT into proxy_new(ip,port,check_time) values('{$deal[$i][1]}','{$deal[$i][2]}','{$deal[$i][6]}') ";
                    execute($link, $sql);
                } else if ($deal[$i][5] == '高匿') {
                    // echo $deal[$i][5];
                    // 排除重复或不行的
                    // echo '<pre>';
                    // print_r($deal[$i]);
                    if ($this->checkChongFu($link, $deal[$i][2])) {
                        continue 1;
                    }
                    $sql = "INSERT into proxy_new(ip,port,check_time) values('{$deal[$i][2]}','{$deal[$i][3]}','{$deal[$i][8]}') ";
                    execute($link, $sql);
                }
            }
        }

        //删除不行的ip
        // $this->delProxy($link);
    }
    //用ip
    public function useProxy($link)
    {
        $sql    = "SELECT ip,port FROM proxy_new WHERE data_state='1'  ORDER BY RAND() LIMIT 1";
        $result = execute($link, $sql);
        if ($row = $result->fetch_assoc()) {
            $proxy = $row['ip'] . ':' . $row['port'];
        } else {
            //抓ip 除了第一次基本不会用到
            $this->grabProxy($link);
            $proxy = $this->useProxy($link);
            echo '没ip了！来自useProxy' . '<br />';
        }
        return $proxy;
    }
    //计时更新
    public function updateTime($link)
    {
        $sql = "UPDATE proxy_new set data_state=0 WHERE adddate(check_time,INTERVAL 1 SECOND)<curtime()";
        execute($link,$sql);
    }
    //假删除ip
    public function updProxy($link, $proxy)
    {
        $proxyArr = explode(':', $proxy);
        $ip       = $proxyArr[0];
        $sql      = "UPDATE proxy_new SET data_state=0 WHERE ip='{$ip}'";
        execute($link, $sql);
    }
    //真删除
    private function delProxy($link)
    {
        $sql = "DELETE FROM proxy_new WHERE data_state=0";
        execute($link, $sql);
    }
    //排除重复
    private function checkChongFu($link, $ip)
    {
        $sql = "SELECT * FROM proxy_new WHERE ip='{$ip}'";
        if (execute($link, $sql)->fetch_assoc()) {
            return 1;
        } else {
            return 0;
        }
    }
}

// $get_api = new get_proxy();
// $get_api->grabProxy($link);
