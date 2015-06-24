<?php
App::uses('AppController', 'Controller');
/**
 * Inds Controller
 *
 * @property Ind $Ind
 * @property PaginatorComponent $Paginator
 */
class IndsController extends AppController {


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

		$this->Ind->recursive = 0;
    $this->Prg->commonProcess();
    $this->paginate = array(
            'conditions' => $this->Ind->parseCriteria($this->passedArgs),
        );

    $this->set('inds', $this->paginate());
    $this->set('select_language',$this->select_language);
    $this->getalphabet();
    //$this->set('indmnk', $all);

    //association
    //これするとメモリ不足でエラー
    //Allowed memory size of 134217728 bytes exhausted (tried to allocate 32 bytes)
    //$all = $this->Ind->find('all');
    //$this->set('all', $all);

    /*$first = $this->Ind->find('first');
    $this->set('first', $first);*/

    $joins=$this->Ind->find('all',
    array(
            "fields" => "*", //*入れないと全部表示されない
            "limit" =>20,
            "joins" => array(
                             array("type" => 'LEFT',
                                   "table" => 'mnks',
                                   //"alias" => 'Mnk',
                                   "conditions" => 'mnks.ind = ind.ind',
                                  ),
                             array("type" => 'LEFT',
                                        "table" => 'zsms',
                                        //"alias" => 'Mnk',
                                        "conditions" => 'zsms.ind = ind.ind',
                                       ),
                       ),
          ));

    $this->set('joins', $joins);

    //レシピの本にのっていたやつ
    //ひっぱってこれない
  /*$indchildren = $this->Ind->find('all',
    array(
      "fields" => "*", //*入れないと全部表示されない
      //"order" => "Ind.id",
      "limit" =>10,
    )
  );
  $this->set('indchildren', $indchildren);
*/
//検索
$query="layak";
$mquery="";
$zquery="";
//リクエストがPOSTの場合
// if($this->request->is('get')){
//debug(isset($this->request->data['Ind']));
 if(isset($this->request->data['Ind'])){
 //Formの値を取得
 //$title=$this->data['Search']['title'];
  $query="";
  $query=$this->request->data['Ind']['ind'];
  //$mquery=$this->request->data['mnks']['mnk'];
  //$query=$this->request->data['Ind']['ind'];
 //POSTされたデータを曖昧検索
  //$searched=$this->Ind->find('all',array(
  //  'conditions'=>array('ind like'=>'%'.$query.'%')));
  //$this->set('searched',$searched);
 }else{ //POST以外の場合
 //適当に初期値
 //$query = "layak";
 //$searched=$this->Ind->find('all');
 //$this->set('searched',$searched);
 }

 $searched=$this->Ind->find('all',array(

   //'conditions'=>array('ind like'=>'%'.$query.'%'),
   'conditions'=>array('Ind.ind = "' .$query .'"'),
   //'conditions'=>array('mnks.mnk = "' .$query .'"'),
   //'conditions'=>array('zsms.zsm = "' .$query .'"'),
   //'conditions'=>array('Ind.ind = "' .$query .'" or mnks.mnk ="'.$mquery.'"'),
   "fields" => "*",
   "joins" => array(
                    array("type" => 'LEFT',
                          "table" => 'mnks',
                          //"alias" => 'Mnk',
                          "conditions" => 'mnks.ind = ind.ind',
                         ),
                    array("type" => 'LEFT',
                               "table" => 'zsms',
                               //"alias" => 'Mnk',
                               "conditions" => 'zsms.ind = ind.ind',
                              ),
              )
   ));
 $this->set('searched',$searched);
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ind->exists($id)) {
			throw new NotFoundException(__('Invalid ind'));
		}
		$options = array('conditions' => array('Ind.' . $this->Ind->primaryKey => $id));
		$this->set('ind', $this->Ind->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ind->create();
			if ($this->Ind->save($this->request->data)) {
				$this->Session->setFlash(__('The ind has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ind could not be saved. Please, try again.'));
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
		if (!$this->Ind->exists($id)) {
			throw new NotFoundException(__('Invalid ind'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ind->save($this->request->data)) {
				$this->Session->setFlash(__('The ind has been saved.'));
				return $this->(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ind could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ind.' . $this->Ind->primaryKey => $id));
			$this->request->data = $this->Ind->find('first', $options);
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
		$this->Ind->id = $id;
		if (!$this->Ind->exists()) {
			throw new NotFoundException(__('Invalid ind'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ind->delete()) {
			$this->Session->setFlash(__('The ind has been deleted.'));
		} else {
			$this->Session->setFlash(__('The ind could not be deleted. Please, try again.'));
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
