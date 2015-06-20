<?php
App::uses('AppController', 'Controller');
/**
 * Zsms Controller
 *
 * @property Zsm $Zsm
 * @property PaginatorComponent $Paginator
 */
class ZsmsController extends AppController {


/**
 * Components
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

		$this->Zsm->recursive = 0;
    $this->Prg->commonProcess();
    $this->paginate = array(
            'conditions' => $this->Zsm->parseCriteria($this->passedArgs),
        );

    $this->set('zsms', $this->paginate());
    $this->set('select_language',$this->select_language);
    $this->getalphabet();
    //$this->set('zsmmnk', $all);

    //association
    //これするとメモリ不足でエラー
    //Allowed memory size of 134217728 bytes exhausted (tried to allocate 32 bytes)
    //$all = $this->Zsm->find('all');
    //$this->set('all', $all);

    /*$first = $this->Zsm->find('first');
    $this->set('first', $first);*/

    $joins=$this->Zsm->find('all',
    array(
            "fields" => "*", //*入れないと全部表示されない
            "limit" =>20,
            "joins" => array(
                             array("type" => 'LEFT',
                                   "table" => 'mnks',
                                   //"alias" => 'Mnk',
                                   "conditions" => 'mnks.ind = zsm.ind',
                                  ),
                       ),
          ));

$this->set('joins', $joins);


	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Zsm->exists($id)) {
			throw new NotFoundException(__('Invalid zsm'));
		}
		$options = array('conditions' => array('Zsm.' . $this->Zsm->primaryKey => $id));
		$this->set('zsm', $this->Zsm->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Zsm->create();
			if ($this->Zsm->save($this->request->data)) {
				$this->Session->setFlash(__('The zsm has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zsm could not be saved. Please, try again.'));
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
	/*public function edit($id = null) {
		if (!$this->Zsm->exists($id)) {
			throw new NotFoundException(__('Invalid zsm'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zsm->save($this->request->data)) {
				$this->Session->setFlash(__('The zsm has been saved.'));
				return $this->(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zsm could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Zsm.' . $this->Zsm->primaryKey => $id));
			$this->request->data = $this->Zsm->find('first', $options);
		}
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Zsm->id = $id;
		if (!$this->Zsm->exists()) {
			throw new NotFoundException(__('Invalid zsm'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Zsm->delete()) {
			$this->Session->setFlash(__('The zsm has been deleted.'));
		} else {
			$this->Session->setFlash(__('The zsm could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



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
