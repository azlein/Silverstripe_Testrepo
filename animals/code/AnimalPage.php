<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 28.10.12
 * Time: 11:41
 */
class AnimalPage extends Page{
    static $allowed_children = array();


	function getCategories(){
		return Category::get();
	}

}

class AnimalPage_Controller extends Page_Controller{
	public static $url_handlers = array(
		''=>'index',
		'search' => 'search',
		'$Category//$ID' => 'handleCall'
	);


	public function init() {
		parent::init();
		Requirements::css('animals/css/animals.css');
		Requirements::css('animals/css/fancybox/jquery.fancybox.css');
		Requirements::css('animals/css/fancybox/helpers/jquery.fancybox-thumbs.css');
		Requirements::javascript('animals/css/fancybox/jquery.fancybox.pack.js');
		Requirements::javascript('animals/css/fancybox/helpers/jquery.fancybox-thumbs.js');
	}

	public function animalSearchForm() {
		return new AnimalSearchForm($this, 'search');
	}

	public function search(array $data, Form $form) {
		$dbEntry = Animal::get()->filter('Name',$data['Name']);

		$tmp = array(
			'animal'=>$dbEntry
		);
		return $this->customise($tmp)->renderWith(array('SingleAnimal','Page'));
	}

	public function index($request){
		return $this->renderWith(array('AnimalPage','Page'));
	}
	public function handleCall($request){
		$id = $request->param('ID');
		if($id == ''){
			return $this->renderCategory($request);
		}else{
			return $this->renderAnimal($request);
		}
	}

	public function renderCategory($request) {
		$category = $request->param('Category');
		$dbEntry = Category::get()->filter('Name', $category);

		if($dbEntry->Count()==0){
			return $this->redirect($this->Link());
		}

		$tmp = array(
			'category' => $dbEntry,
			'activeLink'=>$category
		);
		return $this->customise($tmp)->renderWith(array('AnimalCategory','Page'));
	}

	public function renderAnimal($request){
		$id = $request->param('ID');
		$category = $request->param('Category');

		$dbEntry = Animal::get()->filter('ID',$id) ;
		if($dbEntry->Count()==0){
			return $this->redirect($this->Link());
		}
		$tmp = array(
			'animal'=>$dbEntry,
			'activeLink'=>$category
		);
		return $this->customise($tmp)->renderWith(array('SingleAnimal','Page'));
	}
}