<?php
//京东排行榜

// header("Content-type:text/html;charset=utf-8");
include 'phpQuery.php';
include 'mysqli.php';
function dealRank($ranKing)
{
    $ranKing = trim($ranKing);
    return $ranKing;
}
function dealDiscount($priceCurrent, $priceOriginal)
{
    //如何进一保留2位小数？？
    $discount = round($priceCurrent / $priceOriginal, 2);
    return $discount;
}

function dealMysql($link,$obj)
{
    $obj = mysqli_real_escape_string($link,$obj);
    $obj = "'" . $obj . "'";
    return $obj;
}
//循环页
// '少儿' => 3263 先不抓
//教育 20001；外语学习 3291；中小学辅导 3289；大中专教材教辅 11047；考试 3290；字典词典/工具书 3294；
//小说文学20002；小说3258；文学3259；青春文学3260；传记3261；动漫3272；
// 经管20003；管理3266；金融与投资3265；经济3264；
//励志与成功 3267
//人文社科 20004；历史3273；政治军事3276；心理学3279；法律3277；哲学宗教3274；国学古籍3275；社会科学3281；文化3280；
// $one = array('20001','3291','3289','11047','3290','3294',
//     '20002','3258','3259','3260','3261','3272', 
//     );
$one = array('20003','3266','3265','3264',
    '20004','3273','3276','3279','3277','3274','3275','3281','3280' 
    );
//
  //  
//one

//two
// '近24小时畅销榜' => '0001',
// '近1周畅销榜'   => '0002',
// '近30日畅销榜'  => '0003',
// '1月'       => '-1',
// '2015年'    => '0006',
// '2016年'    => '0005',
$two   = array('0001', '0002', '0003', '-1', '0006', '0005');
$books = [];
foreach ($one as $kind) {
    foreach ($two as $time) {
        for ($page = 1; $page <= 5; $page++) {
            $url = 'http://book.jd.com/booktop/0-0-0.html?category=' . $kind . '-0-0-0-1' . $time . '-' . $page . '#comfort';
            $url = 'http://book.jd.com/booktop/0-0-0.html?category=1713-0-0-0-10001-1#comfort';
            phpquery::newDocumentFile($url);
            //因为原网页所有价格都通过一个文件发过来，通过抓包得该文件套路，根据本页20本书的data-price-id合成url，
            $bookList = pq('.m-list ul li'); //这个pq是对数组
            $priceId  = ''; //用.=要显示赋值一次，否则会提醒
            foreach ($bookList as $li) {
                $book     = pq($li); //这个pq是对变量
                $priceOne = 'J_';
                $priceTwo = $book->find('.p-detail dl:eq(2) dd del')->attr('data-price-id');
                $priceId .= $priceOne . $priceTwo . ',';
            }
            $priceId  = rtrim($priceId, ',');
            $priceUrl = 'http://p.3.cn/prices/mgets?type=1&skuIds=' . $priceId;
            //正则去多余的
            $priceAbout = phpquery::newDocumentFile($priceUrl);
            $reg        = '/\[.*\]/';
            preg_match($reg, $priceAbout, $arr);
            $str        = implode($arr);
            $priceAbout = json_decode($str, true); //json_decode第二个参数为true，即将字符串转化为数组,得原价，现价。
            //下面是常规操作
            $i = 0;
            foreach ($bookList as $li) {
                $book          = pq($li);
                $ranking       = $book->find('.p-num')->text(); //排名
                $img           = $book->find('.p-img a img')->attr('data-lazy-img'); //原网页用js把data-lazy-img的值赋给src
                $urlBook       = $book->find('.p-img a')->attr('href');
                $title         = $book->find('.p-detail a:eq(0)')->text();
                $publish       = $book->find('.p-detail dl:eq(1) dd')->text();
                $priceOriginal = $priceAbout[$i]['m'];
                $priceCurrent  = $priceAbout[$i]['p'];
                $author        = $book->find('.p-detail dl:eq(0) dd a:eq(0)')->text();
                $translate     = $book->find('.p-detail dl:eq(0) dd a:eq(1)')->text();
                $i++;
                //下面这样弄成数组方便入库时传值
                $books[] = [
                    'title'         => dealMysql($link,$title),
                    'author'        => dealMysql($link,$author),
                    'translate'     => dealMysql($link,$translate),
                    'publish'       => dealMysql($link,$publish),
                    'img'           => dealMysql($link,$img),
                    'url'           => dealMysql($link,$urlBook),
                    'priceOriginal' => $priceOriginal,
                    'priceCurrent'  => $priceCurrent,
                    'ranking'       => dealMysql($link,dealRank($ranking)),
                    'time'          => $time,
                    'kind'          => $kind
                    // 'discount' => dealDiscount($priceCurrent,$priceOriginal),
                ];
                // var_dump($books);
                // break;
            }
            // var_dump($books);
            // break;
        }
// var_dump($books);
    }
}

// 入库
foreach ($books as $book) {
    $bookStr = implode(',', $book);
    $sql     = "INSERT INTO ranking(name,author,translate,publish,img,url,price_original,
            price_current,ranking,time,kind) VALUES({$bookStr})";
    execute($link, $sql);
    // break;
}

// var_dump($bookStr);
// break;
