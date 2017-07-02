<?php
class book_belongModel{
    public function insert($info)
    {
        return DB::insert('book_belong', $info);
    }
    public function update($what, $where)
    {
        return DB::update('book_belong', $what, $where);
    }
    public function findByBl_id($bl_id)
    {
        $sql = "SELECT * FROM book_belong WHERE bl_id={$bl_id}";
        return DB::findOne($sql);
    }        
    public function count($s_id,$kind = null){
        if($kind == 1 || $kind == 2){
            $kind = 'AND already_borrow='.$kind;
        }else{
            $kind = null;
        }
        $sql = "SELECT count(*) FROM book_belong WHERE s_id='{$s_id}' {$kind}";
        return DB::count($sql);
    }
    public function findAllByS_id($s_id,$kind = null,$limit = null){
        if($kind == 1 || $kind == 2 ){
            $kind = 'AND already_borrow='.$kind;
        }else{
            $kind = null;
        }
        $sql = "SELECT * FROM book_belong WHERE s_id='{$s_id}' {$kind} {$limit}";
        return DB::findAll($sql);
    }        	      
}