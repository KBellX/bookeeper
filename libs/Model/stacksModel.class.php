<?php
/*
书库-数据表 模型
*/
class stacksModel extends MModel{
    public function insert($info)
    {
        return DB::insert('stacks', $info);
    }
    public function findOnborrow_monthLimit($limit){
    	$sql = "SELECT * FROM stacks ORDER BY create_at LIMIT ".$limit ;
    	return DB::findAll($sql);
    }
    public function findOnborrow_month(){
        $sql = "SELECT * FROM stacks ORDER BY create_at";
        return DB::findAll($sql);
    }    
    public function findByS_id($s_id)
    {
        $sql = "SELECT * FROM stacks WHERE s_id={$s_id}";
        return DB::findOne($sql);
    } 
    public function findByU_id($u_id)
    {
        $sql = "SELECT * FROM stacks WHERE u_id={$u_id}";
        return DB::findOne($sql);
    }
    public function findAllByU_id($u_id)
    {
        $sql = "SELECT * FROM stacks WHERE u_id={$u_id}";
        return DB::findAll($sql);
    }
    public function findLikeName($name)
    {
        $sql = "SELECT * from stacks where name like '%" . $name . "%'";
        return DB::findAll($sql);
    }                      
}
