<?php
//豆瓣每本书信息，打算遍历的
include 'phpQuery.php';

function dealUrlAuthor($urlAuthor)
{
    //get方式传中文会乱码，因此原网页先将中文用urlencode编码了，此处用urldecode解码
    $author = urldecode($urlAuthor);
    $url    = 'book.douban.com' . $author;
    return $url;
}

//info
function dealCongShu($obj)
{
    return str_replace('ISBN', '', $obj);
}
function dealZhuangZhen($obj)
{
    return str_replace('丛书', '', $obj);
}
function dealPrice($obj)
{
    return str_replace('装帧', '', $obj);
}
function dealPage($obj)
{
    return str_replace('定价', '', $obj);
}
function dealTimePublish($obj)
{
    return str_replace('页数', '', $obj);
}
function dealTranslate($obj)
{
    return str_replace('出版年', '', $obj);
}
function dealOriginal($obj)
{
    return str_replace('译者', '', $obj);
}
function dealPublish($obj)
{
    return str_replace('原作名', '', $obj);
}
function dealAuthor($obj)
{
    return str_replace('出版社', '', $obj);
}


    $url = 'https://book.douban.com/subject/26906371';
// $url = 'https://www.douban.com';
    phpquery::newDocumentFile($url);

    $title      = pq('h1 span')->text();
    $content    = pq('.article');
    $img        = $content->find('.subject #mainpic a')->attr('href');
    $urlAuthor  = pq('.article .indent .subjectwrap .subject #info span:eq(0) a')->attr('href');
    $grade      = $content->find('.indent .subjectwrap #interest_sectl .rating_wrap .rating_self strong')->text();
    $numComment = $content->find('.indent .subjectwrap #interest_sectl .rating_wrap .rating_self .rating_right .rating_sum a span')->text();
// $introBook = $content->find('.related_info div span .intro')->html();

//作者介绍之后的抓不到
    // echo $introBook;
    // var_dump($introBook);

//正则匹配
    // $reg = "/^>.*/";
    // $str = $introBook;
    // preg_match($reg, $str, $arr);
    // var_dump($arr);

//书相关信息
    $infoOld = pq('.article .indent .subjectwrap .subject #info')->text();
    $left    = $infoOld;
    $info    = [];
    for ($i = 10; $i >= 1; $i--) {
        //取最右边
        $right = strrchr($left, ':');
        $right = substr($right, 1);
        //留左边
        $num  = strrpos($left, ':');
        $left = substr_replace($left, '', $num);
        //去空格    去不了？？
        $right  = trim($right);
        $info[] = $right;
    }

var_dump($info);

    $isbn       = $info[0];
    $congshu    = dealCongShu($info[1]);
    $ZhuangZhen = dealZhuangZhen($info[2]);
    $price      = dealPrice($info[3]);
    $page       = dealPage($info[4]);
    $time       = dealTimePublish($info[5]);
    $translate  = dealTranslate($info[6]);
    $original   = dealOriginal($info[7]);
    $publish    = dealPublish($info[8]);
    $author     = dealAuthor($info[9]);
    echo $publish;
    // var_dump($congshu);


