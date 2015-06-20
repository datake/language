<?php
App::uses('AppController', 'Controller');
/**
 * Mnks Controller
 *
 * @property Mnk $Mnk
 * @property PaginatorComponent $Paginator
 */
class MnksController extends AppController {


 /* Components
 *
 * @var array
 */
	//public $components = array('Paginator');
  public $components = array('Search.Prg');
  public $presetVars = true;

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mnk->recursive = 0;
    $this->Prg->commonProcess();
    $this->paginate = array(
            'conditions' => $this->Mnk->parseCriteria($this->passedArgs),
        );
    /*$this->paginate = array(
        'conditions' => $this->Mnk->parseCriteria($this->passedArgs),
    );*/
		//$this->set('mnks', $this->Paginator->paginate());
    $this->set('mnks', $this->paginate());
    $this->set('select_language',$this->select_language);
    $this->getalphabet();
    //英語完全一致検索
    //$english = $this->Mnk->english->find('list');
    //$this->set(compact('english'));


    //ルビふり
    /*if ($this->request->is('post')) {
        $this->Session->setFlash('ルビふりsuccess');

    }

    if (empty($this->request->data)) {
    $query = 'Yahoo';//検索したいキーワードを指定

    } else {
        //$query=$this->request->data['Search']['query'];


    }
   $api = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
   $appid = 'dj0zaiZpPWxQaFBRSzBnM1JlTSZzPWNvbnN1bWVyc2VjcmV0Jng9ZjU-';
   $params = array(
       'sentence' => '明鏡止水'
   );

   $ch = curl_init($api);
   curl_setopt_array($ch, array(
       CURLOPT_POST           => true,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
       CURLOPT_POSTFIELDS     => http_build_query($params),
   ));

   $result = curl_exec($ch);
   curl_close($ch);
   $this->set('result',$result);*/

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mnk->exists($id)) {
			throw new NotFoundException(__('Invalid mnk'));
		}
		$options = array('conditions' => array('Mnk.' . $this->Mnk->primaryKey => $id));
		$this->set('mnk', $this->Mnk->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Mnk->create();
			if ($this->Mnk->save($this->request->data)) {
				$this->Session->setFlash(__('The mnk has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mnk could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Mnk->exists($id)) {
			throw new NotFoundException(__('Invalid mnk'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mnk->save($this->request->data)) {
				$this->Session->setFlash(__('The mnk has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mnk could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mnk.' . $this->Mnk->primaryKey => $id));
			$this->request->data = $this->Mnk->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Mnk->id = $id;
		if (!$this->Mnk->exists()) {
			throw new NotFoundException(__('Invalid mnk'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mnk->delete()) {
			$this->Session->setFlash(__('The mnk has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mnk could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

  /*public function search()
{


    $appid=$this->appid_common;

    if ($this->request->is('post')) {
        $this->Session->setFlash('ルビふりsuccess');

    }

    if (empty($this->request->data)) {
    $query = 'Yahoo';//検索したいキーワードを指定

    } else {
        $query=$this->request->data['Search']['query'];


    }


    $hits = array();

    if ($query != "") {
        $query4url = rawurlencode($query);
    //$appid = "dj0zaiZpPWxQaFBRSzBnM1JlTSZzPWNvbnN1bWVyc2VjcmV0Jng9ZjU-";//取得したアプリケーションIDを設定

    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$appid&query=$query4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
    }
    }

    return $hits;
}*/

public function getalphabet(){

$api = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
$appid = 'dj0zaiZpPWxQaFBRSzBnM1JlTSZzPWNvbnN1bWVyc2VjcmV0Jng9ZjU-';
$params = array(
    'sentence' => '明鏡止水'
);

$ch = curl_init($api);
curl_setopt_array($ch, array(
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
    CURLOPT_POSTFIELDS     => http_build_query($params),
));

$result = curl_exec($ch);
curl_close($ch);
//$this->set('result',$result);
return $result;
}
}
