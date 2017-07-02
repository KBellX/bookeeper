<?php
class book_collectionModel extends MModel
{
    public function insert($info)
    {
        return DB::insert('book_collection', $info);
    }
    public function findAllByU_id($u_id)
    {
        $sql = "SELECT * FROM book_collection WHERE u_id={$u_id} AND data_state=1" ;
        return DB::findAll($sql);
    }
    public function update($what, $where)
    {
        return DB::update('book_collection', $what, $where);
    } 
    public function findByU_idAB_id($u_id,$b_id)
    {
        $sql = "SELECT * FROM book_collection WHERE u_id={$u_id} AND b_id={$b_id} AND data_state=1";
        return DB::findOne($sql);
    }           
}
