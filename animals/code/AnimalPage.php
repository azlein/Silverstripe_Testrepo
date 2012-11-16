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

	private $searchForm;

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
		if (isset($data['Hidden'])) {
			Session::set('Name', $data['Name']);
			Session::set('Category',$data['Category']);
			Session::set('Race',$data['Race']);
			Session::set('Color',$data['Color']);
		}


		$filter = array();
		$filter['Name:StartsWith'] = Session::get('Name');

		if(Session::get('Category')!=null)
			$filter['CategoryID'] = Session::get('Category');

		if(Session::get('Race')!=null)
			$filter['Race:PartialMatch'] = Session::get('Race');

		if(Session::get('Color')!=null)
			$filter['Color:PartialMatch'] = Session::get('Color');

		$tmp = array(
			'pagination'=>new PaginatedList(Animal::get()->filter($filter)->sort('Name') , $this->request)
		);
		return $this->customise($tmp)->renderWith(array('AnimalSearchResults','Page'));
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
			'pagination' => new PaginatedList($dbEntry->first()->Animals()->sort('Name'),$this->request),
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