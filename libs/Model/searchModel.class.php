<?php
/*
搜索模型
*/
class searchModel{
	public function fromDouban(){
		//搜索
		//有————入库
		//返回结果
	}
	public function check($data){
		return $data;
	}
	public function stacksName($content){
		$stacks = M('stacks');
		$data_stacks = $stacks->findLikeName($content);
		return $data_stacks;
	}
	public function stacksAdmin($content){
        $account = M('account');
        $data_account = $account->findLikeUsername($content);		
		$stacks = M('stacks');
		foreach($data_account as $a){
			$data_stacks[] = $stacks->findLikeName($content);
		}
		return $data_stacks;
	}	
	public function bookName($content){
		$book = M('book');
		$data_books = $book->findLikeTitle($content);
		return $data_books;
	}	
}