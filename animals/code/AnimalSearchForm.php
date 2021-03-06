<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 09.11.12
 * Time: 11:23
 */
class AnimalSearchForm extends Form{

	public function __construct($controller,$name) {
		$this->addExtraClass('form-horizontal well span7 pull-center offset1');

		$fields = new FieldList();
		$fields->push(new HiddenField('Hidden', 'Hidden', '1'));
		$fields->push(new TextField('Name', _t('Animals.NAME','Name'), Session::get('Name')));

		$category =	new DropdownField('Category', _t('Animals.CATEGORY'),Category::get()->map('ID', 'Name'),Session::get('Category'));
		$category->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION', 'No selection'));
		$category->setHasEmptyDefault(true);
		$fields->push($category);

		$fields->push(new TextField('Race',_t('Animals.RACE','Race'),Session::get('Race')));

		$colorArray = Animal::get()->map('Color', 'Color')->toArray();

		foreach($colorArray as $key=>$value){
			unset($colorArray[$key]);
			$colorArray[strtolower($key)] = strtolower($value);
		}

		$colorArray = array_unique($colorArray);
		$color = new DropdownField('Color',_t('Animals.COLOR','Color'),$colorArray,Session::get('Color'));
		$color->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION','No selection'));
		$color->setHasEmptyDefault(true);
		$fields->push($color);


		$age = new DropdownField('Age',_t('Animals.AGE','Age'));
		$age->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION'),'No selction');
		$age->setHasEmptyDefault(true);
		$fields->push($age);

		$actions = new FieldList(
			FormAction::create("search")->setTitle(_t('AnimalSearchForm.SEARCH','Search'))->addExtraClass('btn btn-primary')
		);

		parent::__construct($controller, $name, $fields, $actions);
	}

	public function forTemplate(){
		return $this->renderWith(array('AnimalSearchForm','Form'));
	}

}