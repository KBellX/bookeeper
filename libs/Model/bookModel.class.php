<?php
/*
书-数据表 模型
*/
class bookModel{
    public function insert($info)
    {
        return DB::insert('book', $info);
    }
    public function update($what, $where)
    {
        return DB::update('book', $what, $where);
    }    
    public function findByb_id($b_id)
    {
        $sql = "SELECT * FROM book WHERE b_id={$b_id} AND data_state=1";
        return DB::findOne($sql);
    }
    public function findByIsbn($isbn)
    {
        $sql = "SELECT * FROM book WHERE isbn='{$isbn}' AND data_state=1";
        return DB::findOne($sql);
    }
    public function findLikeTitle($title)
    {
        $sql = "SELECT * from book WHERE  title like'%" . $title . "%'" ;
        return DB::findAll($sql);
    }
    public function findLikeTitleOne($title)
    {
        $sql = "SELECT * FROM book WHERE title like'%" . $title . "%'";
        return DB::findOne($sql);
    }        		
}