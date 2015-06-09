<?php

class PostsController extends AppController{
     // public $scaffold;
      public $helpers = array('Html', 'Form');
      
      //記事一覧をひっぱってきて変数にセット
      public function index() {
      	 $params = array(
//			'order' => 'modified desc',
			'limit' => 10
		);
      //全ての記事をviewに渡す
      $this->set('posts', $this->Post->find('all'));


      $this->set('title_for_layout', '動画一覧');

	}
    
    
	public function view($id=null){
		$this->Post->id=$id;
		$this->set('post',$this->Post->read());
       
        //test11/13
        //$this->set('post', $this->Post->find('all'));
        //$this->set('history', $this->History->find('all'));

	}

	public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }


    public function edit($id = null) {//$idがわたされる
    	//渡されたidでModelから記事をひっぱってくるためにセット
        $this->Post->id = $id;
        //GETでアクセスされた場合に編集用のフォームを開く
        if ($this->request->is('get')) {
        	//フォームの中に引っ張ってきたモデルの中身をいれる
            $this->request->data = $this->Post->read();
        } else {
        	//ユーザがデータを編集してそのフォームがPOSTされた時の処理、まずデータの保存をする。
        	
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
  
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->request->is('ajax')) {//ajaxかどうかしる
            if ($this->Post->delete($id)) {//削除試みる
            	//削除できたらviewをレンダリングしない
                $this->autoRender = false;
                $this->autoLayout = false;
                //どのpostが消されたかをidをJSON形式でviewに返す
                $response = array('id' => $id);
                $this->header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }

        $this->redirect(array('action'=>'index'));
    }
} 


  