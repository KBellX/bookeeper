<?php
/*
验证 模型
 */

class authModel
{
    public $errAccount; //用户登陆注册报错信息
    public $errStack;   //创建书库报错信息
    public $auth; //信息(用户或书库)
    public function __construct(){
        //有没办法获取实例化authModel类的类的类名？？？
        $this->init_stack();
        $this->init_account();
    }
    public function basic_check(){
        //对各种类型的输入的基本验证，转义
    }
    private function init_stack(){
        $this->errStack[0] = '图书馆名称不得为空!';
        $this->errStack[1] = '图书管名称不得超过48个字!';
        $this->errStack[2] = '图书管简介不得超过255个字!';
        $this->errStack[4] = '账号不符合格式!';
        $this->errStack[5] = '请先阅读并同意条款!';
    }
    private function init_account(){
        $this->errAccount[0] = '账号不得为空!';
        $this->errAccount[1] = '密码不得为空！';
        $this->errAccount[2] = '密码不得少于6位数!';
        $this->errAccount[3] = '账号或密码有错误!';
        $this->errAccount[4] = '该账号已被注册!';
        $this->errAccount[5] = '邮箱格式不对!';
        $this->errAccount[6] = '该用户已登陆!';
    }    
    public function checkCreate(){        
        try{
            $data = $_POST['data'];
            if(!isset($data['name']) || empty($data['name'])){
                throw new Exception(0);
            }
            if(mb_strlen($data['name']) > 48){
                throw new Exception(1);
            }
            if(isset($data['desc']) && mb_strlen($data['desc']) > 48){
                throw new Exception(2);
            }
            return 'ok';                        
        }catch(Exception $e){
            $i = $e->getmessage();
            return $this->errStack[$i];
        }
    }      
    public function checkLogin()
    {
        try {
            //初步检验要转义吗？
            $email = $_POST['email'];
            $password = $_POST['password'];
            //3）初步检验submit
            $result = $this->firstAccount($email, $password);
            if ($result != 'ok' ) {
                throw new Exception($result);
            }
            //4）与数据库交互检验submit
            $result = $this->dbAccountLogin($email, $password);
            if ($result != 'ok') {
                throw new Exception($result);
            }      
            return 'ok';
        } catch (Exception $e) {
            $str = $e->getmessage();
            return $str;
        }
    }
    public function checkRegister()
    {
        try {
            $email  = $_POST['email'];
            $password  = $_POST['password'];
            //3）初步检验submit
            $result = $this->firstAccount($email, $password);
            if ($result != 'ok' ) {
                throw new Exception($result);
            }
            //4）数据库检验及操作
            $result = $this->dbAccountRegister($email, $password);
            if ($result != 'ok') {
                throw new Exception($result);
            }        
            return 'ok';
        } catch (Exception $e) {
            $str = $e->getmessage();
            return $str;
        }
    }
    private function firstAccount($email, $password)
    {
        try {
            if (empty($email)) {
                throw new Exception(0);
            }
            if (empty($password)) {
                throw new Exception(1);
            }
            if (mb_strlen($password) < 6) {
                throw new Exception(2);
            }
            return 'ok';
        } catch (Exception $e) {
            $i = $e->getMessage();
            return $this->errAccount[$i];
        }
    }
    private function dbAccountRegister($email, $password)
    {
        $email = DB::escape($email);
        $password = DB::escape($password);        
        $account    = M('account');
        $this->auth = $account->findByEmail($email);
        try{
            if (isset($this->auth)) {
                throw new Exception(4);
            }
            return 'ok';            
        }catch (Exception $e) {
            $i = $e->getMessage();
            return $this->errAccount[$i];
        }        
    }
    private function dbAccountLogin($email, $password)
    {
        $email = DB::escape($email);
        $password = DB::escape($password);
        $account    = M('account');
        $this->auth = $account->findByEmail($email);  
        try{          
            if ($this->auth['password'] != md5($password)) {
                throw new Exception(3);
            }
            if (1 == $this->auth['online']) {
                throw new Exception(6);
            }
            return 'ok';            
        }catch (Exception $e) {
            $i = $e->getMessage();
            return $this->errAccount[$i];
        }

    }
}
