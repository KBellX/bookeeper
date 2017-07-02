<?php
/*
抓中国图书网
数据入库漏了，是因为抓时没漏了
*/
// header("Content-type: text/html; charset=gb2312");
error_reporting(E_ALL || ~E_NOTICE); //显示除去 E_NOTICE 之外的所有错误信息
require 'curl_multi_single.php';
require '../../mysql.php';
use QL\QueryList;

class multi_zgtsw extends curl_multi_single
{
    public function dealData($conns, $link)
    {
        foreach ($conns as $conn) {
            $html = curl_multi_getcontent($conn); // 获得爬取的代码字符串
            //处理info，书基本信息
            $values = $this->grabInfo($html, $link);
            //有可能抓到空
            if ($values) {
                $other = $this->dealOther($html); //处理标题，图片，分类
                $this->dealInsert($link, $values, $other); //入库
            }
        }
    }
    private function grabInfo($html, $link)
    {
        $rules_info = array(
            'p0' => array('.book_infor p:eq(0)', 'text'),
            'p1' => array('.book_infor p:eq(1)', 'text'),
            'p2' => array('.book_infor p:eq(2)', 'text'),
            'p3' => array('.book_infor p:eq(3)', 'text'),
            'p4' => array('.book_infor p:eq(4)', 'text'),
            'p5' => array('.book_infor p:eq(5)', 'text'),
            'p6' => array('.book_infor p:eq(6)', 'text'),
        );
        $info = QueryList::Query($html, $rules_info)->data;
        if (empty($info)) {
            $this->dealNull($link);
            return 0;
        } else {
            $values = $this->dealInfo($info[0]);
            return $values;
        }
    }
    private function dealInfo($info)
    {
        foreach ($info as &$value) {
            $value = iconv('gb2312', 'utf-8', $value); //转换字符编码
        }
        foreach ($info as &$value) {
            $value = explode('：', $value);
        }
        $values = array();
        foreach ($info as $p) {
            if ($p[0] == '作者') {
                $values['author'] = $p[1];
            }
            if ($p[0] == '出版社') {
                $values['publisher'] = $this->dealPublish($p[1]);
            }
            if ($p[0] == '所属丛书') {
                $values['congshu'] = $this->dealCongshu($p[1]);
            }if ($p[0] == 'ISBN') {
                $values['isbn']        = $this->dealIsbn($p[1]);
                $values['timePublish'] = $p[2];
            }if ($p[0] == '开本') {
                if (isset($p[2])) {
                    $values['page'] = $p[2];
                }
            }if ($p[0] == '定价') {
                $values['price'] = $p[1];
            }
        }
        return $values;
    }
    private function dealOther($html)
    {
        $rules_other = array(
            'title' => array('.this_book h1', 'text'),
            'img'   => array('.this_book_cover img', 'src'),
            'kind'  => array('.this_crumb', 'text'),
        );
        $other = QueryList::Query($html, $rules_other)->data;
        foreach ($other[0] as &$value) {
            $value = iconv('gb2312', 'utf-8', $value); //转换字符编码
        }
        $other[0]['img'] = $this->dealImg($other[0]['img']);
        $other[0]['kind'] = $this->dealKind($other[0]['title'], $other[0]['kind']);
        return $other[0];
    }
    private function dealInsert($link, $info, $other)
    {
        $fields = '';
        $values = '';
        foreach ($info as $value) {
            $fields[] = key($info);
            next($info);
            $values[] = $this->escape($link, $value);
        }
        foreach ($other as $value) {
            $fields[] = key($other);
            next($other);
            $values[] = $this->escape($link, $value);
        }
        $values = implode(',', $values);
        $fields = implode(',', $fields);
        $sql    = "INSERT INTO book_zgtsw({$fields}) VALUES({$values})";
        execute($link, $sql);
    }
    private function dealKind($title, $kindFirst)
    {

        $kind     = str_replace('中国图书网&gt;&gt; ', '', $kindFirst);
        $kind     = str_replace(' &gt;&gt;' . $title, '', $kind);
        $kindLast = str_replace(" &gt;&gt; ", '&', $kind);
        if ($kindFirst == $kindLast) {
            $kindLast = '';
        }
        return $kindLast;
    }
    private function dealImg($img)
    {
        if (substr($img, 0, 4) != 'http') {
            $img = '';
        }
        return $img;
    }
    private function dealPublish($publisher)
    {
        $publisher = str_replace('本社特价书', '', $publisher);
        $publisher = rtrim($publisher);
        return $publisher;
    }
    private function dealCongshu($congshu)
    {
        $congshu = str_replace('册数', '', $congshu);
        return $congshu;
    }
    private function dealIsbn($isbn)
    {
        $isbn = str_replace('出版时间', '', $isbn);
        $isbn = str_replace(" &#160;", "", $isbn);
        return $isbn;
    }
    private function dealNull($link)
    {
        $sql = "INSERT INTO book_zgtsw(data_state) VALUES(0)";
        execute($link, $sql);
    }
    private function escape($link, $obj)
    {
        $obj = mysqli_real_escape_string($link, $obj);
        $obj = "'" . $obj . "'";
        return $obj;
    }
}

//测试
// $urls = array(
//     // 'http://www.bookschina.com/7365863.htm'
// );
// $obj = new multi_zgtsw($urls, $link);
// die;

// 多线程跑一个网站
$sql    = "SELECT * FROM book_url_zgtsw WHERE data_state=1";
$result = execute($link, $sql);
$url    = 'http://www.bookschina.com';
while ($data = mysqli_fetch_assoc($result)) {
    echo $data['url'] . '<br />';
    $urls[] = $url . $data['url'];
    if ($data['id'] % 8 == 0) {
        $obj  = new multi_zgtsw($urls, $link);
        $urls = '';
        echo '————'.'<br />';
        //处理url数据库
        $first = $data['id'] - 8;
        $sql = "UPDATE book_url_zgtsw SET data_state=0 WHERE id>{$first} AND id<={$data['id']}";
        execute($link,$sql);
        // die;
    }
}


//判断是漏了还是真的抓不到

//传id
// function dealOldId(){

// }
