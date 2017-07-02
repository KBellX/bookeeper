<?php
$proxy = "118.69.202.160";
$proxyport = "3128";
$ch = curl_init("http://www.111cn.net/phper/php-cy/121920.htm");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_PROXY,$proxy);
curl_setopt($ch,CURLOPT_PROXYPORT,$proxyport);
curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
$result = curl_exec($ch);
echo $result;
curl_close($ch);