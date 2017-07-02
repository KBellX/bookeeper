<?php
/*
 *curl相关
 */
function genCurl($url, $userAgent = null, $proxy = null, $post = null, $cookieFIle = null, $cookie = null)
{
    $curl = curl_init(); //初始化
    curl_setopt($curl, CURLOPT_URL, $url); //访问url
    if ($proxy) {
        curl_setopt($curl, CURLOPT_PROXY, $proxy);
    }
    if ($post) {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    if ($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookieFIle);
    }
    if ($userAgent) {
    	$userAgent = getUserAgent();
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //模拟UA
    }
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //访问https
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //访问https
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
    // curl_setopt($curl, CURLOPT_REFERER, "http://www.jb51.net/ ");
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 重定向时，自动设置 header 中的Referer:信息
    $referer = 'https://book.douban.com/';
    curl_setopt($curl, CURLOPT_REFERER, $referer); //构造来路
    // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);    //跟随重定向
    @curl_setopt($curl, CURLOPT_TIMEOUT, 10); //设置超时
    $data = curl_exec($curl); //执行请求
    if (curl_errno($curl)) {
        echo 'Errno' . curl_error($curl); // 捕抓异常
        return;
    }
    curl_close($curl); //关闭curl
    return $data;
}

function getUserAgent()
{
    $userAgentArr = array(
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
        'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0',
        "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0",
        'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.22 Safari/537.36 SE 2.X MetaSr 1.0',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)',
        'User-Agent,Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv,2.0.1) Gecko/20100101 Firefox/4.0.1', 'User-Agent,Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
        'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html) ',
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'Sogou web spider/4.0(+http://www.sogou.com/docs/help/webmasters.htm#07)',
        'Mozilla/5.0 (compatible; Yahoo! Slurp/3.0; http://help.yahoo.com/help/us/ysearch/slurp)',
        'Mozilla/5.0 (compatible; Yahoo! Slurp China; http://misc.yahoo.com.cn/help.html)',
        'Mozilla/5.0 (compatible; YoudaoBot/1.0; http://www.youdao.com/help/webmaster/spider/; )',
    );
    $userAgent = $userAgentArr[mt_rand(0, count($userAgentArr) - 1)];
    return $userAgent;
}

// $post = array(
//     'form_email'    => '15581646116',
//     'form_password' => 'zq6198218',
//     'login'         => '登录',
// );
// $cookieFIle = dirname(__FILE__) . '/cookie.txt';
// $cookieFIle = 'bid=B1BqTLatZQW';
// $url = 'https://www.douban.com/';    //豆瓣首页
// $url = 'https://book.douban.com/';//豆瓣读书页
// $url = 'https://book.douban.com/subject/26968417/';    //某本书页
// $url = 'https://www.douban.com/people/153675668/';    //个人主页
// $url = 'https://www.douban.com/accounts/login';    //豆瓣登陆
// echo genCurl($url,1,$post=,$cookieFIle);
// echo genCurl($url,1);
