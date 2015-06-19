<?php
App::uses('AppModel', 'Model');
/**
 * Dictionary Model
 *
 */
class Dictionary extends AppModel {

	public $order = array('Post.id DESC');
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
			//'kana' => array('type' => 'like'),//部分一致検索
			'kanji' => array('type' => 'value'),//完全一致検索
			'english' => array('type' => 'value'),
			'german' => array('type' => 'value'),
			'janum' => array('type' => 'value'),
			'ennum' => array('type' => 'value'),
			'denum' => array('type' => 'value'),
	);
}
