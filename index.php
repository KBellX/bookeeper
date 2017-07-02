<?php
header("Content-type: text/html; charset=utf-8");
session_start();
require_once 'config.php'; //引入配置文件
require_once 'framework/pc.class.php'; //引入框架，启动引擎
// PC::$config = $config; //配置信息给到各种引擎,在pc类里赋值了
PC::run($config); //启动，框架可用了
