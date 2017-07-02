<?php
/*
*采集或运用ip
*/
require '../mysql.php';
//采集ip
// function get_proxy(){

// }
//用ip
function use_proxy($link){
	$sql = "SELECT id,ip,proxy FROM ip WHERE data_state=1 AND id=mt_rand(40)";
	$result = execute($link,$sql);
	$data = mysqli_fetch_assoc($result);
	$proxy = $data['ip'].':'.$data['proxy'];
	return $proxy;
}
//冷藏ip
function set_proxy($link,$proxy){
	
	// $sql = "UPDATE "

}