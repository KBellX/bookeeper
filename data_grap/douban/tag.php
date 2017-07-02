<?php
require '../QueryList/vendor/autoload.php';
include '../mysqli.php';

use QL\QueryList;

function dealUrl($tag)
{
    $url = 'https://book.douban.com/tag/' . $tag;
    return $url;
}
function dealTotal($total)
{
    $total = ltrim($total, '(');
    $total = rtrim($total, ')');
    return $total;
}

function dealMysql($link, $obj)
{
    $obj = mysqli_real_escape_string($link, $obj);
    $obj = "'" . $obj . "'";
    return $obj;
}

$page  = 'https://book.douban.com/tag/';
$rules = array(
    'name'  => array('[class="tagCol"] a', 'text'),
    'total' => array('[class="tagCol"] b', 'text'),
);
$data = QueryList::Query($page, $rules)->data;
//$data为所有标签
// echo '<pre>';
// print_r($data[0]);

//入库准备，准备好字段
$ziduan = ['name', 'url', 'kind'];
$ziduan = implode(',', $ziduan);
//防屏蔽
// 遍历每个便签
foreach ($data as $tag) {
    // $books = '';    //清空数组
    // 标签名称 $tag['name']
    $urlList = dealUrl($tag['name']);
    $total   = dealTotal($tag['total']); //该标签书数量
    // $numAll = ceil($total/20);
    //一个标签的n页
    for ($num = 0; $num <= $total + 20; $num += 20) {
        // 此处控制页数
        echo $num;
        echo '<br />';
        // for($num = 280;$num <= 280; $num+=20){
        // $num =
        $urlBook = '';
        $urlBook = $urlList . '?start=' . $num . '&type=R';
        //判断该分类是否没有书了
        $ruleFound = array(
            'noFound' => array('[class="pl2"]', 'text'),
        );
        $noFound = QueryList::Query($urlBook, $ruleFound)->data;
        if (isset($noFound[0]['noFound'])) {
            echo '找不到' . '<br />';
            break;
        }
        //抓每本书标题，url
        $rules = array(
            'title' => array('.subject-item .info h2 a', 'text'),
            'link'  => array('.subject-item .info h2 a', 'href'),
        );
        $books = QueryList::Query($urlBook, $rules)->data;
        //每页入库一次
        foreach ($books as $book) {
            //为每条数据添加其分类这个值
            $book['tag'] = $tag['name'];
            //入库
            $values = '';
            foreach ($book as $value) {
                $values .= dealMysql($link, $value) . ',';
            }
            $values = rtrim($values, ',');
            $sql    = "INSERT INTO douban_url({$ziduan}) VALUES({$values})";
            // echo $sql;
            execute($link, $sql);
        }
        // echo '<pre>';
        // print_r($books);
        // break;
    }
    sleep(rand(7, 18));
    // echo '<pre>';
    // print_r($books);
    // break;
}
