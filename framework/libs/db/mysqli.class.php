<?php
/*
mysqli数据库类，可以被数据库引擎启动
 */

class mysql_i
{
    //连接句柄
    public $mysqli;
    //报错提示
    private function err()
    {
        if ($this->mysqli->errno) {
            echo $this->mysqli->error;
        }
    }
    //连接
    public function connect($config)
    {
        extract($config); //将数据变为对应变量
        $this->mysqli = new mysqli($host, $user, $pwd, $db_name);
        $this->err();
        $this->mysqli->set_charset($characterset);
        //设置字符集

    }
    public function query($sql)
    {
        $result = $this->mysqli->query($sql);
        $this->err();
        return $result;
    }
    //查找一个
    public function findOne($query)
    {
        $rs = $query->fetch_assoc();
        $this->err();
        return $rs;
    }
    public function count($query)
    {
        $rs = $query->fetch_row();
        $this->err();
        return $rs[0];
    }    
    //查找多个
    public function findAll($query)
    {
        while ($rs = $query->fetch_assoc()) {
            $list[] = $rs;
        }
        $this->err();
        return isset($list) ? $list : '';
    }
    //插入
    public function insert($table, $arr)
    {
        foreach ($arr as $key => $value) {
            $keyArr[]   = "`" . $key . "`";
            $value      = $this->escape($value);
            $valueArr[] = "'" . $value . "'";
        }
        $keys   = implode(',', $keyArr);
        $values = implode(',', $valueArr);
        $sql    = "INSERT INTO {$table}({$keys}) VALUES({$values})";
        $result = $this->query($sql);
        return $this->mysqli->insert_id; //返回插入id
    }
    //更新
    public function update($table,$arr,$where){
    	foreach($arr as $key=>$value){
    		$value = $this->escape($value);
    		$keyANDvalueArr[] = "`{$key}`='{$value}'";
    	}
    	$keyANDvalues = implode(',',$keyANDvalueArr);
    	$sql = "UPDATE {$table} SET {$keyANDvalues} WHERE {$where}";
    	return $this->query($sql);
    }
    //转义
    public function escape($str){
        return $this->mysqli->escape_string($str);
    }
}

// $obj = new mysql_i();
// $obj->connect($config['db']);
//查
// $sql    = "SELECT * FROM user WHERE id=11";
// $result = $obj->query($sql);
// $obj->findAll($result);
// $obj->findOne($result);
//插入
// $table = 'user';
// $arr = [
//     'user_name' => 'aa',
//     'password' => '1',
// ];
// $obj->insert($table,$arr);
//更新
// $where = 'id=11';
// $obj->update($table,$arr,$where);
