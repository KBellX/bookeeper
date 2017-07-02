<?php
class searchController extends CController{
    private $search;
    public function accessRules()
    {
        $this->allowRoles = ['tourist','me','other'];
        $this->allowActions = ['route','StacksName'];
        $this->title = '搜索';
    }
    public function actionRoute(){
        $this->search = M('search');       
        if(isset($_POST['search'])){
            if($_POST['kind'] == '1'){ 
                $this->actionStacksName();
            }
            // if($_POST['kind'] == '2'){ 
            //     $this->actionStacksAdmin();
            // }                        
            // if($_POST['kind'] == '3'){
            //     $this->actionBookTitle();
            // }           
        }
        $this->err();
    }    
    public function actionStacksName(){
        if(!isset($_POST['content'])){
            $this->err();
        }
        $this->title = '搜索结果';        
        $account = M('account');
        $data_search = $this->search->stacksName($_POST['content']);
        $this->render('stacks',
            ['data_search' => $data_search,
            'account' => $account]
            );
        die;        
    }
    private function actionStacksAdmin(){
        $account = M('account');
        $data_search = $this->search->stacksAdmin($_POST['content']);
        $this->render('stacks',
            ['data_search' => $data_search,
            'account' => $account]
            );
        die;
    }
    private function actionBookTitle(){
        $account = M('account');
        $data_search = $this->search->bookName($_POST['content']);
        $this->render('book',
            ['data_search' => $data_search,
            'account' => $account]
            ); 
        die;       
    }    
}