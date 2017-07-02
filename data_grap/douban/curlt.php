<?php
//我的ip 113.247.251.69
//模拟ip
for ($i = 1100000, $time = 1; $i <= 1100100; $i++, $time++) {
    $url = "https://api.douban.com/v2/book/{$i}";
    // $url = 'https://www.baidu.com/';
    // $url = 'https://book.douban.com/subject/1220562/';
    $curl = curl_init(); // 启动一个CURL会话
    $ip   = '106.46.136.178';
    $port = '808';
    $proxy = $ip.':'.$port;
    // curl_setopt($curl, CURLOPT_PROXY, $proxy);

    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在

    $user_agent =  "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36";
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);	//模拟UA
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer

    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    echo '<pre>';
    print_r($tmpInfo);
    echo '哈哈';
    // exit;
    if (curl_errno($curl)) {
        echo 'Errno' . curl_error($curl); // 捕抓异常
        return;
    }
    curl_close($curl); // 关闭CURL会话
}
