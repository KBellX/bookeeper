<?php
//京东各栏目信息

header("Content-type:text/html;charset=GBK");
function deal($kind){
	//原//book.jd.com/booktop/3263-0-0-0-10001-10007-1.html#comfort	
	$kind = strrchr($kind, '/');
	//变为/3263-0-0-0-10001-10007-1.html#comfort
	$kind = substr($kind, 1);
	//变为3263-0-0-0-10001-10007-1.html#comfort
	$kind = explode('-',$kind);
	//分割数组第一个为3263
	return $kind[0];
}

include 'phpquery.php';

$url = 'http://book.jd.com/booktop/0-0-0.html?category=1713-0-0-0-10001-1#comfort';
phpquery::newDocumentFile($url);

$kindList = pq('.mc');
$a = $kindList->html();

var_dump($a);


// $kindList = pq('.mc');
// $shaoer = $kindList->find('a:eq(0)')->attr('href');

// $jiaoyu = $kindList->find('dl:eq(0) dt a')->attr('href');
// $waiyuxuexi = $kindList->find('dl:eq(0) dd a:eq(0)')->attr('href');
// $zhongxiaoxue = $kindList->find('dl:eq(0) dd a:eq(1)')->attr('href');
// $dazhongzhuan = $kindList->find('dl:eq(0) dd a:eq(2)')->attr('href');
// $kaoshi = $kindList->find('dl:eq(0) dd a:eq(3)')->attr('href');
// $zidian = $kindList->find('dl:eq(0) dd a:eq(4)')->attr('href');

// $xiaoshuowenxue = $kindList->find('dl:eq(1) dt a')->attr('href');
// $xiaoshuo = $kindList->find('dl:eq(1) dd a:eq(0)')->attr('href');
// $wenxue = $kindList->find('dl:eq(1) dd a:eq(1)')->attr('href');
// $qingchunwenxue = $kindList->find('dl:eq(1) dd a:eq(2)')->attr('href');
// $zhuanji = $kindList->find('dl:eq(1) dd a:eq(3)')->attr('href');
// $dongman = $kindList->find('dl:eq(1) dd a:eq(4)')->attr('href');

// $jingguan = $kindList->find('dl:eq(2) dt a')->attr('href');
// $guanli = $kindList->find('dl:eq(2) dd a:eq(0)')->attr('href');
// $jingrong = $kindList->find('dl:eq(2) dd a:eq(1)')->attr('href');
// $jingji = $kindList->find('dl:eq(2) dd a:eq(2)')->attr('href');



// $lizhiyuchenggong = pq('.mc > a:eq(1)')->attr('href');
// //这样为何不行
// // $lizhiyuchenggong = $kindList->children('a:eq(1)')->text();

// $renwensheke = $kindList->find('dl:eq(3) dt a')->attr('href');

// $shenghuo = $kindList->find('dl:eq(4) dt a')->attr('href');

// $yishu = $kindList->find('dl:eq(5) dt a')->attr('href');

// $keji = $kindList->find('dl:eq(6) dt a')->attr('href');

// $jisuanji = pq('.mc > a:eq(2)')->attr('href');

// $yingwenshu = $kindList->find('dl:eq(7) dt a')->attr('href');

// $qikanzazhi = pq('.mc > a:eq(3)')->attr('href');
// echo deal($xiaoshuo);

