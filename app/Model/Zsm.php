<?php
App::uses('AppModel', 'Model');
/**
 * Dictionary Model
 *
 */
class Zsm extends AppModel {

	public $name = 'Zsm';
	/*public $hasOne = array(
		""
		"className" => "Mnk",
		"foreignKey" => "ind");*/


	//var $primaryKey = 'ind';

	/*var $belongsTo = array(
    "Detail2" => array(
      "className" => "Mnk",
      "foreignKey" => "ind",
    ),
  );*/

	//これわりかしうまくいきそうだった
  /*var $belongsTo = array(
    "Mnk" => array(
      "className" => "Mnk",
      "foreignKey" => "ind",
			'conditions'=>array('Mnk.ind = Zsm.ind')
    ),
  );*/

	var $hasMany = array(
		"Mnk" => array(
			"className" => "Mnk",
			"foreignKey" => "ind",
			'conditions'=>array('Mnk.ind = Zsm.ind')
		),
	);



	//public $order = array('Post.id DESC');
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
			//'kana' => array('type' => 'like'),//部分一致検索
			/*'kanji' => array('type' => 'value'),//完全一致検索
			'english' => array('type' => 'value'),
			'german' => array('type' => 'value'),
			'janum' => array('type' => 'value'),
			'ennum' => array('type' => 'value'),
			'denum' => array('type' => 'value'),*/
			'ind' => array('type' => 'like'),
			'zsm' => array('type' => 'like'),
			'mnk' => array('type' => 'like'),
	);
}
