<?php
class book_borrowModel{
    public function insert($info)
    {
        return DB::insert('book_borrow', $info);
    }
    public function update($what, $where)
    {
        return DB::update('book_borrow', $what, $where);
    }    
    public function findAllByU_id($u_id,$state)
    {
        $sql = "SELECT * FROM book_borrow WHERE u_id={$u_id} AND state={$state}";
        return DB::findAll($sql);
    }
    public function findByBl_id($bl_id)
    {
        $sql = "SELECT * FROM book_borrow WHERE bl_id={$bl_id}";
        return DB::findOne($sql);
    }
    public function findByBr_id($br_id)
    {
        $sql = "SELECT * FROM book_borrow WHERE br_id={$br_id}";
        return DB::findOne($sql);
    }        
    public function findAllByY_id($y_id,$state)
    {
        $sql = "SELECT * FROM book_borrow WHERE y_id={$y_id} AND state={$state}";
        return DB::findAll($sql);
    }            
}