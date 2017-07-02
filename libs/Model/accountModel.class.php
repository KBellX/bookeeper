<?php
/*
用户-数据表 模型
 */
class accountModel
{
    public function findByUsername($username)
    {
        $sql = "SELECT * FROM account WHERE username={$username} AND data_state=1";
        return DB::findONe($sql);
    }
    public function findByU_id($u_id)
    {
        $sql = "SELECT * FROM account WHERE u_id={$u_id} AND data_state=1";
        return DB::findOne($sql);
    }
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM account WHERE email='{$email}' AND data_state=1";
        return DB::findOne($sql);
    }        
    public function insert($info)
    {
        return DB::insert('account', $info);
    }
    public function update($what, $where)
    {
        return DB::update('account', $what, $where);
    }    
}
