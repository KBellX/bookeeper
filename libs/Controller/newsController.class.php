<?php

class newsController extends CController
{
    public function accessRules()
    {
        $this->allowRoles = ['me'];
        $this->allowActions = ['ask', 'return'];
    }
    public function actionAsk()
    {
        $this->title = '他人请求';        
        $book = M('book');
        $account = M('account');
        $book_belong = M('book_belong');
        $u_id = $_SESSION['u_id'];
        $book_borrow = M('book_borrow');
        $stacks = M('stacks');
        if(isset($_POST['agree'])){
            foreach($_POST['ask'] as $key=>$value){
                //同意借出
                $br_id = $key;
                $what['state'] = 1;
                $where = "br_id={$br_id}";
                $book_borrow->update($what,$where);
                //书出库
                $data_book_borrow = $book_borrow->findByBr_id($br_id);   
                $a['already_borrow'] = 2;
                $where = "bl_id=".$data_book_borrow['bl_id'];            
                $book_belong->update($a,$where);                 
                //记录借阅次数
                $data_book_belong = $book_belong->findByBl_id($data_book_borrow['bl_id']);
                $b_id = $data_book_belong['b_id'];
                $data_book = $book->findByb_id($b_id);
                $b['num'] = $data_book['num'] + 1;
                $where = "b_id={$b_id}";
                $book->update($b,$where);
            }            
        }
        if(isset($_POST['disagree'])){
            foreach($_POST['ask'] as $key=>$value){
                $br_id = $key;
                $what['state'] = 3;
                $where = "br_id={$br_id}";
                $book_borrow->update($what,$where);                
            }            
        }
        if(isset($_POST['agreea'])){
            // 同意借出
            $br_id = $_POST['agreea']['id'];
            $what['state'] = 1;
            $where = "br_id={$br_id}";
            $book_borrow->update($what,$where);
            //书出库
            $data_book_borrow = $book_borrow->findByBr_id($br_id);   
            $a['already_borrow'] = 2;
            $where = "bl_id=".$data_book_borrow['bl_id'];            
            $book_belong->update($a,$where);                 
            //记录借阅次数
            $data_book_belong = $book_belong->findByBl_id($data_book_borrow['bl_id']);
            $b_id = $data_book_belong['b_id'];
            $data_book = $book->findByb_id($b_id);
            $b['num'] = $data_book['num'] + 1;
            $where = "b_id={$b_id}";
            $book->update($b,$where);
            die;
        }
        if(isset($_POST['disagreea'])){
            $br_id = $_POST['disagreea']['id'];
            $what['state'] = 3;
            $where = "br_id={$br_id}";
            $book_borrow->update($what,$where);  
            die;                          
        }                
        $data_book_borrow = $book_borrow->findAllByY_id($u_id,0);       
        $this->render('ask',[
            'account' => $account,
            'book' => $book,
            'book_belong' => $book_belong,
            'stacks' => $stacks,
            'data_book_borrow' => $data_book_borrow
            ]);
    }
    public function actionReturn()
    {
        $this->title = '确认归还';        
        $book = M('book');
        $account = M('account');
        $book_belong = M('book_belong');
        $u_id = $_SESSION['u_id'];
        $book_borrow = M('book_borrow');
        $stacks = M('stacks');
        if(isset($_POST['submit'])){
            foreach($_POST['return'] as $key=>$value){
                $br_id = $key;
                $what['state'] = 2;
                $where = "br_id={$br_id}";
                $book_borrow->update($what,$where);
                //在库
                $data_book_borrow = $book_borrow->findByBr_id($br_id);   
                $a['already_borrow'] = 1;
                $where = "bl_id=".$data_book_borrow['bl_id'];            
                $book_belong->update($a,$where);                 
            }            
        }
        if(isset($_POST['returna'])){
            $br_id = $_POST['returna']['id'];
            $what['state'] = 2;
            $where = "br_id={$br_id}";
            $book_borrow->update($what,$where);
            //在库
            $data_book_borrow = $book_borrow->findByBr_id($br_id);   
            $a['already_borrow'] = 1;
            $where = "bl_id=".$data_book_borrow['bl_id'];            
            $book_belong->update($a,$where);
            echo $data_book_borrow['bl_id'];
            die;           
        }                        
        $data_book_borrow = $book_borrow->findAllByY_id($u_id,1);       
        $this->render('return',[
            'account' => $account,
            'book' => $book,
            'book_belong' => $book_belong,
            'stacks' => $stacks,
            'data_book_borrow' => $data_book_borrow
            ]);
    }    
}
