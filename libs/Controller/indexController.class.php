<?php
class indexController extends CController{
	public function accessRules(){
		$this->allowRoles = ['me','other','tourist'];
        $this->allowActions = ['index'];
        $this->title = 'Bookeeper';
	}	
	public function actionindex(){
		$stacks = M('stacks');
		$data_stack = $stacks->findOnborrow_monthLimit(6);
		$account = M('account');	
		$this->render('index',
			array('data_stack' => $data_stack,
			 'account' => $account,
				)
			,2);
	}
}