<?php
/*模拟浏览器类
使用该类示例
$url = 'https://book.douban.com/';
$obj = new imitateBrowser();
$html = $obj->curl($url);
 */
// $url = 'https://www.douban.com/';
// $url = 'http://www.awaimai.com/';
$url = 'http://kbell.me/testphp.php';
$obj = new imitateBrowser();
$referer = 'https://www.douban.com/';
// $curl = $obj->curl($url,1,0,0,0,0,$referer);
$curl = $obj->curl($url,1);
// var_dump($curl);
echo $curl;
class imitateBrowser
{
    public $url;
    // public function __construct($url)
    // {
    //     //初始化变量,要么在curl方法中不设形参$url，要么直接在构造方法里调用curl方法，不然这样初始化没意义
    //     $this->url = $url;
    //     //应该在这里调用curl方法吗？是否意味着每抓一个网站就要new一个对象
    //     // $this->curl($this->$url, $userAgent, $proxy);
    // }
    public function curl($url, $userAgent = null, $proxy = null, $noData = null, $timeout = 5, $isFollowLoc = null, $referer = null, $post = null, $cookie = null)
    {
        $curl = curl_init(); //初始化
        curl_setopt($curl, CURLOPT_URL, $url); //访问url
        if ($userAgent) {
            $this->useUA($curl);
        }
        if ($proxy) {
            $this->useProxy($curl, $proxy);
        }
        $this->setTimeout($curl, $timeout);
        if ($isFollowLoc) {
            $this->isFollowLoc($curl);
        }
        if ($referer) {
            $this->setReferer($curl, $referer);
        }
        if ($post) {
            $this->post($curl, $post);
        }
        if ($cookie) {
            $this->cookie($curl, $cookie);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //访问https
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //访问https
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 重定向时，自动设置 header 中的Referer:信息
        if ($noData) {
            return $curl;
        } else {
            $data = curl_exec($curl); //执行请求
            if (curl_errno($curl)) {
                echo 'Errno' . curl_error($curl); // 捕抓异常
                return;
            }
            return $data;
        }
        curl_close($curl); //关闭curl

    }
    //使用ip代理
    private function useProxy($curl, $proxy)
    {
        curl_setopt($curl, CURLOPT_PROXY, $proxy);
    }
    private function useUA($curl)
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
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //模拟UA
    }
    //设置超时
    private function setTimeout($curl, $timeout)
    {
        @curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    }
    //跟随重定向
    private function isFollowLoc($curl)
    {
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    }
    //设置来路
    private function setReferer($curl, $referer)
    {
        curl_setopt($curl, CURLOPT_REFERER, $referer);
    }
    //post
    private function post($curl, $post)
    {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    private function cookie($curl, $cookie)
    {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookieFIle);
    }
}
