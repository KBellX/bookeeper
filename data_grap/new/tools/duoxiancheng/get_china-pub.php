<?php
//error_reporting(E_ALL);
header("Content-type: text/html; charset=gb2312");
error_reporting(E_ALL || ~E_NOTICE); //显示除去 E_NOTICE 之外的所有错误信息
require 'curl_multi_single.php';
require '../../mysql.php';
use QL\QueryList;

$timeStart = time();
class multi_chinapub extends curl_multi_single
{
    public function dealData($conns, $link)
    {
        foreach ($conns as $conn) {
            $html = curl_multi_getcontent($conn); // 获得爬取的代码字符串
            // echo $html;
            $rules = array(
                'noFound' => array('h1', 'text'),
                'title'   => array('#right .pro_book h1', 'text'), //要处理标题
                'img'     => array('#right .pro_book_img img', 'src'),
            );
            $data = QueryList::Query($html, $rules)->data;
            //如果漏了
            if (!isset($data[0]['noFound'])) {
                echo '1';
                $data_state = 0;
                $sql        = "INSERT INTO book_chinapub(data_state) VALUES({$data_state})";
                execute($link, $sql);
            } else {
                //如果该书不存在，依然入库为空
                $fields = ['title', 'img'];
                $fields = implode(',', $fields);
                $book   = [
                    $this->dealInsert($link, $this->dealTitle($data[0]['title'])),
                    $this->dealInsert($link, $data[0]['img']),
                ];
                $values = implode(',', $book);
                $data   = implode(',', $data[0]);
                $sql    = "INSERT INTO book_chinapub($fields) VALUES($values)";
                execute($link, $sql);
            }

        }
    }
    private function dealTitle($title)
    {
        $title = trim($title);
        return $title;
    }
    private function dealInsert($link, $obj)
    {
        $obj = mysqli_real_escape_string($link, $obj);
        $obj = "'" . $obj . "'";
        return $obj;
    }
}
// $obj = new multi_chinapub($urls, $link);

// $numList = count($list) - 1;
for ($i = $numStart; $i <= $numEnd; $i++) {
    $url    = 'http://product.china-pub.com/' . $i;
    $urls[] = $url;
    if ($i % 10 == 0) {
        $obj  = new multi_chinapub($urls, $link);
        $urls = '';
    }
}


