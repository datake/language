<?php
App::uses('AppModel', 'Model');
/**
 * Dictionary Model
 *
 */
class Mnk extends AppModel {

	public $name = 'Mnk';
	//var $primaryKey = 'ind';



	//public $order = array('Post.id DESC');
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'ind' => array('type' => 'like'),
		'mnk' => array('type' => 'like'),
	);
}
