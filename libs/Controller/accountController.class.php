<?php
/*
用户控制器
 */

class accountController extends CController
{
    public function accessRules()
    {
        $this->allowRoles = ['tourist','me'];
        $this->allowActions = ['index', 'login', 'register', 'logout', 'info'];
        $this->title = '用户';
    }
    public function actionIndex()
    {
        $this->title = '首页';
        if($this->role != 'me'){
            $this->err();
        }
        $this->render('index');
    }
    public function actionLogin()
    {
        if($this->role != 'tourist'){
            $this->err();
        }
        if (isset($_POST['submit'])) {
            $auth = M('auth');
            $result = $auth->checkLogin();
            if ('ok' == $result) {
                $u_id = $auth->auth['u_id'];    //if条件成立，说明$auth->auth可用
                //用户上线处理
                $account = M('account');
                $online['online'] = 0;
                $where = "u_id={$u_id}";
                if($account->update($online,$where)){
                    $_SESSION['u_id'] = $u_id;
                    $this->skip('?controller=account&method=index&u_id=' . $u_id);
                }                      
            } else {
                $this->skip('?controller=index&method=index',$result);
            }
        }
    }
    public function actionRegister()
    {
        if($this->role != 'tourist'){
            $this->err();
        }
        if (isset($_POST['submit'])) {
            $auth = M('auth');
            $result = $auth->checkRegister();
            if ('ok' == $result) {
                $account = M('account');
                $info['email']    = DB::escape($_POST['email']);
                $info['password']    = md5(DB::escape($_POST['password']));
                $info['username'] = $_POST['username'];
                $u_id                = $account->insert($info);
                //用户上线处理
                $online['online'] = 0;
                $where = "u_id={$u_id}";
                if($account->update($online,$where)){
                    $_SESSION['u_id'] = $u_id;
                    $this->skip('?controller=account&method=index&u_id=' . $u_id);
                }          
            } else {
                $this->skip('?controller=index&method=index',$result);
            }
        }
    }
    public function actionLogout()
    {
        if($this->role != 'me'){
            $this->err();
        }
        //用户下线处理
        $account = M('account');
        $online['online'] = 0;
        $where = "u_id={$_SESSION['u_id']}";
        if($account->update($online,$where)){
            // $_SESSION['u_id'] = '';
            unset($_SESSION['u_id']);
            $this->skip('?controller=index&method=index');
        }
    }
    public function actionInfo()
    {
        if($this->role != 'me'){
            $this->err();
        }
        $this->title = '个人中心';        
        $u_id = $_GET['u_id'];  //这里应该在getrole里判断的，最终应该以get_id为准
        $account = M('account');        
        if(isset($_POST['data'])){
            // var_dump($_POST['data']);
            $info['username'] = $_POST['data']['username'];
            $info['sex'] = $_POST['data']['sex'];
            $info['desc'] = $_POST['data']['desc'];
            $where = "u_id={$u_id}";
            if($account->update($info,$where)){
                // skip("?controller=account&method=info&u_id={$u_id}");
            }
            die;
            //这里为什么能work暂时没弄懂
        }
        $data_account = $account->findByU_id($u_id);
        $this->render('info',
            ['data_account' => $data_account]
            ,2);
    }
}
