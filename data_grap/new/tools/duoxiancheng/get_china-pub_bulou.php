<?php
require 'get_china-pub.php';
//补漏
class bulou extends multi_chinapub
{
    public function dealData($ids,$link)
    {
        foreach ($ids as $id) {
            if (!isset($data[0]['noFound'])) {
                //不update
            } else {
                $sql = "UPDATE book_chinapub SET($fields) = $values WHERE id={$id}";
                execute($link, $sql);
            }
        }
    }
}

class bulouall
{
    public function __construct($link)
    {
    	$this->do($link);
        //最后check
        $this->check($link);
    }
    private function check($link)
    {
        $sql    = "SELECT * FROM book_chinapub WHERE data_state=0";
        $result = execute($link, $sql);
        if ($data = mysqli_fetch_assoc($result)) {
            new bulouall($link);
        }
    }
    function do($a) {
        $sql    = "SELECT * FROM book_chinapub WHERE data_state=0";
        $result = execute($link, $sql);
        $i      = 1;
        while ($data = mysqli_fetch_assoc($result)) {
            $url    = 'http://product.china-pub.com/' . $data['id'];
            $urls[] = $url;
            $ids[]  = $data['id'];
            if ($i % 10 == 0) {
                $obj  = new bulou($ids,$link);
                $urls = '';
                $ids  = '';
            }
            $i++;
        }
    }
}

new bulouall($link);