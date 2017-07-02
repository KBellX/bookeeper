<?php
/*
报错处理模型
*/
class errModel extends MModel{
	private $message = array();	
	public function __construct(){
		$this->setMessage();
	}
	private function setMessage(){
		$this->message[0] = '找不到该网页。。';	
		$this->message[1] = '没被授权';
	}
	public function returnErr($i=0){
		return $this->message[$i];
	}
}