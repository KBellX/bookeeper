<?php
/*
书控制器
*/
class bookController extends CController{
	public function accessRules(){
        $this->allowRoles = ['tourist','me','other'];
        $this->allowActions = ['book','collection','input','info'];

	}
	public function actionInfo(){
		if(!isset($_GET['b_id'])){
            $this->err();			
		}
		$this->title = '图书详情';
		$b_id = $_GET['b_id'];
		$book = M('book');
		$data_book = $book->findByb_id($b_id);
		$this->renderpartial('info',
			['data_book' => $data_book]
				);
	}
	public function actionCollection(){
        if($this->role != 'me'){
            $this->err();
        }
        $this->title = '收藏书单';
		if(isset($_POST['re'])){
			$book_collection = M('book_collection');
			$what['data_state'] = 0;
			$where = "c_id=".$_POST['re']['id'];
			$book_collection->update($what,$where);
			die;
		}        		
		$u_id = $_SESSION['u_id'];
		$book = M('book');
		$book_collection = M('book_collection');
		$data_book_collection = $book_collection->findAllByU_id($u_id);
		$this->render('collection',
			['data_book_collection' => $data_book_collection,
				'book' => $book,
			]
			);
	}
	public function actionInput(){
		$this->title = '录入书籍';
        if($this->role != 'me'){
            $this->err();
        }		
		if(isset($_POST['data'])){
			$data = $_POST['data'];
			$search = M('search');
			$data = $search->check($data);
			$book = M('book');
			if(!empty($data['isbn'])){
				$data_book = $book->findByIsbn($data['isbn']);
				if(empty($data_book)){
					$search =  M('search');
					$search->fromDouban();
				}
			}
			if(!empty($data['name'])){
				$data_book = $book->findLikeTitleOne($data['name']);
				if(empty($data_book)){
					$search =  M('search');
					$search->fromDouban();
				}
			}
			echo json_encode($data_book);
			die;
		}
		if(isset($_POST['b_id'])){
			$info['s_id'] = $_GET['s_id'];
			$info['b_id'] = $_POST['b_id'];
			$book_belong = M('book_belong');
			$book_belong->insert($info);
			die;
		}
		$this->render('input');
	}
}