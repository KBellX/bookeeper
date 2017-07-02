<?php
/*
抓豆瓣api页
*/
require 'get_proxy_class_new.php';
$fields = [
    'rating_max', 'rating_numRaters', 'rating_average', 'rating_min', 'subtitle',
    'author', 'pubdate', 'tags', 'origin_title', 'translator', 'catalog', 'pages', 'douban_id',
    'publisher', 'isbn10', 'isbn13', 'title', 'author_intro', 'summary', 'price',
];
$fields = implode(',', $fields);
//开始时间
$timeStart = time();
$numStart  = 1002215;
$numEnd    = 1002310;
//我的ip
$myIp    = 1;
$get_api = new get_proxy();
$ch      = new imitateBrowser();
for ($i = $numStart; $i <= $numEnd; $i++) {
    $url = 'https://api.douban.com/v2/book/' . $i;
    // $url = 'https://book.douban.com/subject/' . $i . '/';
    //我的ip
    if (time() - $myiptime > 3600) {
        $myIp = 1;
    }
    if ($myIp) {
        $data = $ch->curl($url, 1);
        // sleep(mt_rand(0, 2));
    } else {
        //跟新ip时间
        // $get_api->updateTime($link);
        //获取ip
        $proxy = $get_api->useProxy($link);
        // $ip = '106.46.136.245';
        // $port = '808';
        // $proxy = $ip.':'.$proxy;
        $data = $ch->curl($url, 1, $proxy);
        //???json_decode转义了\n如何取消
    }
    $data = json_decode($data, true); //第二个参数为true，即转化为数组
    // echo '<pre>';
    // print_r($data);
    // die;
    if (isset($data['code'])) {
        //id不属于书的，进入下一个循环
        if ($data['code'] == 6000) {
            echo '不存在这本书' . '<br />';
            continue 1;
        }
        //我的ip被禁了
        if ($data['code'] == 112) {
            echo '我的ip不行了' . '<br />';
            $i        = $i - 1; //再次抓这个id
            $myIp     = 0;
            $myiptime = time();
            continue 1;
        }
    }
    if (is_null($data)) {
        echo '该ip不行了' . '<br />';
        $get_api->updProxy($link, $proxy);
        $i = $i - 1;
        continue 1;
    }
    $values = dealData($link, $data);
    // echo '<pre>';
    // print_r($values);
    //入库
    $sql = "INSERT INTO douban_book({$fields}) VALUES({$values})";
    // echo $sql;
    execute($link, $sql);
    echo $i . '成功<br />';
}

//结束时间
$timeEnd = time();
echo '用时:' . date('H:i:s', $timeEnd - $timeStart) . '<br />';
echo '共抓到 ' . ($numEnd - $numStart + 1) . ' 条数据';

function dealData($link, $data)
{
    //如果想批量入库，设个变量入10的倍数，$book[],入库时foreach，再implode，最后清空str，book
    $book = [
        dealInsert($link, $data['rating']['max']),
        dealInsert($link, $data['rating']['numRaters']),
        dealInsert($link, $data['rating']['average']),
        dealInsert($link, $data['rating']['min']),
        dealInsert($link, $data['subtitle']),
        dealInsert($link, dealOneArray($data['author'])),
        dealInsert($link, $data['pubdate']),
        dealInsert($link, dealTags($data['tags'])),
        dealInsert($link, $data['origin_title']),
        dealInsert($link, dealOneArray($data['translator'])),
        dealInsert($link, $data['catalog']),
        dealInsert($link, dealPage($data['pages'])),
        dealInsert($link, $data['id']),
        dealInsert($link, $data['publisher']),
        dealInsert($link, $data['isbn10']),
        dealInsert($link, $data['isbn13']),
        dealInsert($link, $data['title']),
        dealInsert($link, $data['author_intro']),
        dealInsert($link, $data['summary']),
        dealInsert($link, $data['price']),
    ];
    $book = implode(',', $book);
    return $book;
}
function dealInsert($link, $obj)
{
    $obj = mysqli_real_escape_string($link, $obj);
    $obj = "'" . $obj . "'";
    return $obj;
}
function dealPage($page)
{
    if (empty($page)) {
        return 0;
    } else {
        return $page;
    }
}
function dealOneArray($dataOneArray)
{
    $result = '';
    if (isset($dataOneArray[1])) {
        $result = implode('&', $dataOneArray);
    } elseif (isset($dataOneArray[0])) {
        $result = $dataOneArray[0];
    }
    return $result;
}
function dealTags($dataTags)
{
    $tags = '';
    if (isset($dataTags[1])) {
        $tags = '';
        foreach ($dataTags as $oneTag) {
            $tags .= $oneTag['name'] . '&';
        }
        $tags = rtrim($tags, '&');
    } elseif (isset($dataTags[0])) {
        $tags = $dataTags[0]['name'];
    }
    return $tags;
}
