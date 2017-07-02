<?php
/*
数据库引擎

数据库工厂模式
使用静态！ 

不管用的是哪种数据库，都能用DB::方式调用

数据库连接究竟是怎么回事???
 */
class DB
{
    public static $db;
    //初始化数据库操作类和配置
    public static function init($dbtype, $config)
    {
        self::$db = new $dbtype;
        self::$db->connect($config);
    }
    public static function query($sql)
    {
        return self::$db->query($sql);
    }
    public static function findOne($sql)
    {
        $query = self::$db->query($sql);
        return self::$db->findOne($query);
    }
    public static function findAll($query)
    {
        $query = self::$db->query($query);
        return self::$db->findAll($query);
    }
    public static function insert($table, $arr)
    {
        return self::$db->insert($table, $arr);
    }
    public static function update($table, $arr, $where)
    {
        return self::$db->update($table, $arr, $where);
    }
    public static function escape($str){
        return self::$db->escape($str);
    }
    public static function count($sql)
    {
        $query = self::$db->query($sql);
        return self::$db->count($query);
    }    
}

// DB::init($config);