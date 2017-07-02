<?php
/*
书库控制器
*/
class stacksController extends CController{
	public function accessRules(){
        $this->allowRoles = ['tourist','me','other'];
        $this->allowActions = ['list','create','stack'];
        $this->title = '图书馆';
	}
	public function actionList(){
        $this->title = '图书馆列表';		
		$stacks = M('stacks');
		$data_stack = $stacks->findOnborrow_month();
		$account = M('account');	
		$this->render('list',
			array(
			 'data_stack' => $data_stack,
			 'account' => $account,
				)
			);
	}
	public function actionCreate(){		
        if($this->role != 'me'){
            $this->err();
        }
        $this->title = '创建新的图书馆';        
		$stacks = M('stacks');	
		$upload = M('upload');		
		if(isset($_FILES['small'])){
			$samll = $upload->small();
			die;
		}
		if(isset($_FILES['big'])){
			$samll = $upload->big();
			die;
		}				
		if(isset($_POST['data'])){
			$model = M('auth');
			$result = $model->checkCreate();
			if($result == 'ok'){
				$data['u_id'] = $_SESSION['u_id'];
				$data['name'] = $_POST['data']['name'];
				$data['desc'] = $_POST['data']['desc'];
				$data['is_open'] = $_POST['data']['is_open'];
				$data['s_img'] = $_POST['data']['small'];
				$data['b_img'] = $_POST['data']['big'];
				$s_id = $stacks->insert($data);
				echo $s_id;
			}else{
				echo null;
			}
			die;
		}
		$this->render('create');
	}
	public function actionStack(){
		if(!isset($_GET['s_id'])){
            $this->err();
		}
        $this->title = '图书馆';		
		$s_id = $_GET['s_id'];
		$stacks = M('stacks');
		$data_stacks = $stacks->findByS_id($s_id);		
		if(isset($_POST['borrow'])){
			$book_borrow = M('book_borrow');
			$info['u_id'] = $_SESSION['u_id'];
			$info['y_id'] = $data_stacks['u_id'];
			$info['bl_id'] = $_POST['borrow']['id']; 
			$book_borrow->insert($info);
			die;
		}
		if(isset($_POST['collect'])){
			$book_collection = M('book_collection');
			$info['u_id'] = $_SESSION['u_id'];
			$info['b_id'] = $_POST['collect']['id']; 
			//查是否已收藏
			$data = $book_collection->findByU_idAB_id($info['u_id'],$info['b_id']);
			if(empty($data)){
				$book_collection->insert($info);
			}			
			die;
		}		
		$book_belong = M('book_belong');
		$book = M('book');
		$this->render('stack',
			['book_belong' => $book_belong,
			 'book' => $book,
			 'data_stacks' => $data_stacks,
			]
			);
	}
}