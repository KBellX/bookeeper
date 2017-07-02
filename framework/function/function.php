<?php
function C($name, $method)
{
    require_once 'libs/Controller/' . $name . 'Controller.class.php';
    $Controller = $name . 'Controller';
    $obj        = new $Controller();
    $method = 'action'.ucfirst($method);
    $obj->$method();
}

function M($name)
{
    require_once 'libs/Model/' . $name . 'Model.class.php';
    $Model = $name . 'Model';
    $obj   = new $Model();
    return $obj;
}
function display($view){
    require_once 'tpl/'.$view;
}

function daddslashes($str)
{
    $str = (!get_magic_quotes_gpc()) ? addslashes($str) : $str;
    return $str;
}

//分页函数
function page($count,$page_size=5,$num_btn=5,$page='page'){
    if(!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page]<1){
        $_GET[$page]=1;
    }
    $page_num_all=ceil($count/$page_size); 
    if($page_num_all==0){
        $page_num_all=1;
    }
    if($_GET[$page]>$page_num_all){
        $_GET[$page]=$page_num_all;
    }
    $current_url=$_SERVER['REQUEST_URI'];   
    $arr_current=parse_url($current_url);   
    $current_path=$arr_current['path'];     
    if(isset($arr_current['query'])){   
        parse_str($arr_current['query'],$arr_query);
        unset($arr_query[$page]);       
        if(empty($arr_query)){
            $url="{$current_path}?{$page}=";
        }else{
            $current_othre=http_build_query($arr_query);    
            $url="{$current_path}?{$current_othre}&{$page}=";
        }
    }else{
        $url="{$current_path}?{$page}=";
    }
    if($num_btn>=$page_num_all){
        for($i=1;$i<=$page_num_all;$i++){
            if($i==$_GET[$page]){
                $html[$i]="<li class='active'><span>{$i}</span></li>";
            }else{
                $html[$i]="<li><a href='{$url}{$i}'>{$i}</a></li>";
            }
        }
    }else{
        $left_page=floor(($num_btn-1)/2);   
        $start_page=$_GET[$page]-$left_page;    
        $end_page=$start_page+($num_btn-1);
        if($start_page<1){
            $start_page=1;
        }
        if($end_page>$page_num_all){
            $start_page=$page_num_all-($num_btn-1);
        }
        for($i=1;$i<=$num_btn;$i++){
            if($start_page==$_GET[$page]){
                $html[$start_page]="<li><span>{$start_page}</span></li>";
            }else{
                $html[$start_page]="<li><a href='{$url}{$start_page}'>{$start_page}</a></li>";
            }
            $start_page++;
        }
        if($num_btn>3){
            $key_first=key($html);
            end($html);
            $key_last=key($html);
            if($key_first!=1){
                array_shift($html);
                array_unshift($html,"<li><a href='test.php?page=1'>|&lt;</a></li>");
            }
            if($key_last!=$page_num_all){
                array_pop($html);
                array_push($html,"<li><a href='{$url}{$page_num_all}'>&gt;|</a></li>");
            }
        }
    }
    //上一页，下一页
    if($_GET[$page]!=1){
        $prey=$_GET[$page]-1;
        array_unshift($html,"<li><a href='{$url}{$prey}'>&lt;</a></li>");
    }
    if($_GET[$page]!=$page_num_all){
        $next=$_GET[$page]+1;
        array_push($html,"<li><a href='{$url}{$next}'>&gt;</a></li>");
    }
    //数据库相关
    $start=($_GET[$page]-1)*$page_size;
    $limit="limit {$start},{$page_size}";
    //将一维数组合成字符串
    $html=implode(' ',$html);
    $data = array(
            'limit' => $limit,
            'html'  => $html,
    );
    return $data;
}