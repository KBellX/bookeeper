<?php
include '../phpQuery.php';
/*
*模拟登陆（豆瓣）
*/
// 先post看返回什么，保存返回的到txt

//CURLOPT_COOKIE 	或 CURLOPT_COOKIEFILE

function login_post($url, $cookie, $post) { 
    $curl = curl_init();//初始化curl模块 
    curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址 
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息 
	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	//访问https
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);	//访问https


    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息 
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中 
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交 
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息 
    curl_exec($curl);//执行cURL 
    curl_close($curl);//关闭cURL资源，并且释放系统资源 
} 
//登录成功后获取数据 
function get_content($url, $cookie) { 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	//访问https
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);	//访问https

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie 
    $rs = curl_exec($ch); //执行cURL抓取页面内容 
    curl_close($ch); 
    return $rs; 
} 

$post = array ( 
    'form_email' => '15581646116',
    'form_password' => 'zq6198218',
    'login' => '登录' 
); 
//登录地址 
$url = "https://accounts.douban.com/login";
//设置cookie保存路径 
// $cookie = 'cookie.txt';
$cookie = dirname(__FILE__) . '/cookie_oschina.txt';  
// login_post($url,$cookie,$post);



//登录后要获取信息的地址 
$url2 = "https://book.douban.com/subject/26968417/"; 
//模拟登录 
login_post($url, $cookie, $post); 
//获取登录页的信息 
// $cookie = 'bid=ERO57Fl06QM';
// $content = get_content($url2, $cookie); 

//删除cookie文件 
// @ unlink($cookie); 


//获得用户信息
// $url3 = 'https://www.douban.com/people/153675668/';
$url3 = 'https://book.douban.com/';
// $url3 = 'server.php';
// $cookie = 'bid=gD93ne8c_cs';
$content = get_content($url3, $cookie); 
// $content = file_get_contents($url3);
echo $content;