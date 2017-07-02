<?php
/*
启动引擎库
 */
$currentdir = dirname(__FILE__);
require_once $currentdir . '/include.list.php'; //引入清单文件
foreach ($paths as $path) {
    //引入各种引擎，及某一种内容，值，如mysqli
    require_once $currentdir . $path;
}
class PC
{
    //配置信息在framework外，因为不单只框架需要配置，那么如何转一个
    public static $controller;
    public static $method;
    private static $config;
//启动数据库引擎
    private static function init_db()
    {
        DB::init(self::$config['dbconfig']['dbtype'], self::$config['dbconfig']['info']);
    }
//启动视图引擎
    // private static function init_view()
    // {
    //     VIEW::init(self::$config['viewconfig']['viewtype'], self::$config['viewconfig']['info']);
    // }
    private static function init_controllor()
    {
        if(!isset($_GET['controller'])){
            self::$controller = 'index';
        }else{
            self::$controller = in_array($_GET['controller'],self::$config['allowControllers'])?daddslashes($_GET['controller']):'err';
        }
    }
    private static function init_method()
    {
        self::$method = isset($_GET['method']) ? daddslashes($_GET['method']) : 'index';
    }
//启动总引擎
    public static function run($config)
    {
        // $this->init_db();    //静态方法里不能访问非静态方法，变量
        self::$config = $config;
        self::init_db();
        // self::init_view();
        self::init_controllor();
        self::init_method();
        C(self::$controller, self::$method);
    }
}
