<?php
/*
控制器基类
 */
class CController
{
    public $title;
    private $childName;
    public $role;
    public $action;
    public $allowRoles   = array();
    public $allowActions = array();
    public function __construct()
    {
        $this->getChildName();
        $this->filters(); //子类可覆盖
        $this->getRole(); //不变
        $this->getAction(); //不变
        $this->accessrules(); //子类可覆盖
        $this->check(); //不变
    }
    private function getChildName()
    {
        $this->childName = __class__;
    }
    //过滤url
    protected function filters()
    {   

    }
    //身份，方法验证
    protected function accessRules()
    {
        // $this->allowRoles
        //子类赋值$this->allowRoles和$this->allowActions
    }
    private function check()
    {
        if (!in_array($this->role, $this->allowRoles)) {
            $this->err();
        }
        if (!in_array($this->action, $this->allowActions)) {
            $this->err();
        }
    }
    //跳转,或弹窗提示后跳转
    public function skip($url, $message = null)
    {
        if (isset($message)) {
            echo "<script>alert('{$message}');</script>";
        }
        echo "<script>window.location.href='{$url}';</script>";
    }
    //跳到错误页面并提示错误信息（严重错误）
    public function err($messageNum = 0)
    {
        $this->skip('?controller=err&method=err');
    }
    //渲染视图
    public function render($view, $data = null, $layout = 1)
    {
        isset($data) ? extract($data) : ''; //将key作为变量名，value作为值
        $path = str_replace('Controller', '', get_called_class());
        $view = $path . '/' . $view . '.php';
        require_once 'libs/View/layouts/header' . $layout . '.php';
        require_once 'libs/View/' . $view;
        require_once 'libs/View/layouts/footer' . $layout . '.php';
    }
    public function renderpartial($view,$data = null){
        isset($data) ? extract($data) : '';
        $path = str_replace('Controller', '', get_called_class());
        $view = $path . '/' . $view . '.php';
        require_once 'libs/View/' . $view;                
    }
    //使用小部件
    public function widget($view, $data = null)
    {
        isset($data) ? extract($data) : ''; //将key作为变量名，value作为值
        $rs = require_once 'components/widgets/' . $view . '.php';
        return $rs;
    }
    private function getRole()
    {
        try {
            if (!isset($_SESSION['u_id'])) {
                $this->role = 'tourist';
                throw new Exception();
            }
            if (isset($_GET['u_id'])) {
                $u_id = $_GET['u_id'];
            } else {
                if (isset($_GET['s_id'])) {
                    $stacks = M('stacks');
                    $data_stacks = $stacks->findByS_id($_GET['s_id']);
                    $u_id   = $data_stacks['u_id'];
                }
            }
            if (isset($u_id) && ($u_id == $_SESSION['u_id'])) {
                $this->role = 'me';
                throw new Exception();
            }
            $this->role = 'other';
        } catch (Exception $e) {

        }
    }
    private function getAction()
    {
        $this->action = PC::$method;
    }
    //弹出报错信息不跳转
    public function errAlert($button, $message)
    {
$html = <<<A
<script>
$(document).ready(function(){
    $("#{$button}").click(function(){
        alert("{$message}");
    });
});
</script>
A;
        echo $html;
    }
}
