<?php
/*
报错控制器
*/
class errController extends CController{
    public function accessRules()
    {
        $this->allowRoles = ['tourist','me','other'];
        $this->allowActions = ['err'];
        $this->title = 'Bookeeper';
    }
	public function actionErr(){
        $err  = M('err');
        $message = $err->returnErr();
        $this->render('err', ['message' => $message]);
	}
}