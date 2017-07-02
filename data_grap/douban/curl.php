<?php
include '../phpQuery.php';
for ($i = 1100000,$time = 1; $i <= 1100000; $i++,$time++) {
	// if($time%10 == 0){
	// 	sleep(rand(15,25));
	// }
    $url = "https://api.douban.com/v2/book/{$i}";
	$curl = curl_init();    //初始化一个curl对象
	// $url = "https://book.douban.com/subject/26910001/";
	// $url = "https://www.tmall.com/";
	// $url = "bell/douban/server.php";


    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_URL, "bell/douban/server.php"); 

	// ip代理
	// $proxy = "80.25.199.25";
	// $proxyport = "8080";
	// curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
	// curl_setopt($curl,CURLOPT_PROXYAUTH,$proxy);
	// curl_setopt($curl,CURLOPT_PROXYPORT,$proxyport);
	// curl_setopt ($curl, CURLOPT_TIMEOUT, 120);


	// curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
	// curl_setopt($curl, CURLOPT_PROXY, "218.76.43.253"); //代理服务器地址
	// curl_setopt($curl, CURLOPT_PROXYPORT, 8080); //代理服务器端口
	// curl_setopt($curl, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
	// curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

    $header = array(        //构造头部
        'CLIENT-IP:58.68.44.62', 
        'X-FORWARDED-FOR:58.68.44.62', 
    );
	// curl_setopt($curl, CURLOPT_HEADER, 1);	//常规header设置

    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	//访问https
	// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);	//访问https
    
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 	//改ip

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	// 获取的信息以文件流的形式返回
    
    // curl_setopt($curl, CURLOPT_REFERER, "http://www.jb51.net/ "); //构造来路 

    // $user_agent =  "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36";
    // curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);	//模拟UA 

	

    $str = curl_exec($curl);    //执行请求  

	// $str = json_decode($str,true);
	// echo '<pre>';
	// print_r($str['author']);
	// print_r($str);
	// echo '<h1>哈哈</h1>';

    curl_close($curl);    //关闭c
    echo $str;    //输出抓取的结果  


// ip代理
// $proxy = "80.25.198.25";
// $proxyport = "8080";
// $ch = curl_init("http://sfbay.craigslist.org/");



// curl_setopt($ch, curlOPT_RETURNTRANSFER,1);
// curl_setopt($ch,curlOPT_proxy,$proxy);
// curl_setopt($ch,curlOPT_proxyPORT,$proxyport);
// curl_setopt ($ch, CURLOPT_TIMEOUT, 120);



// $result = curl_exec($ch);
// echo $result;

// curl_close($ch);

}
    