<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 09.11.12
 * Time: 11:23
 */
class AnimalSearchForm extends Form{

	public function __construct($controller,$name) {
		$fields = new FieldList();
		$fields->push(new HiddenField('Hidden', 'Hidden', '1'));
		$fields->push(new TextField('Name', _t('Animals.NAME','Name'), Session::get('Name')));

		$category =	new DropdownField('Category', _t('Animals.CATEGORY'),Category::get()->map('ID', 'Name'));
		$category->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION', 'No selection'));
		$category->setHasEmptyDefault(true);
		$fields->push($category);

		$fields->push(new TextField('Race',_t('Animals.RACE','Race')));

		$colorArray = Animal::get()->map('Color', 'Color')->toArray();
		$colorArray = array_unique($colorArray);
		$color = new DropdownField('Color',_t('Animals.COLOR','Color'),$colorArray);
		$color->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION','No selection'));
		$color->setHasEmptyDefault(true);
		$fields->push($color);


		$actions = new FieldList(
			FormAction::create("search")->setTitle(_t('AnimalSearchForm.SEARCH','Search'))->addExtraClass('btn btn-primary')
		);

		parent::__construct($controller, $name, $fields, $actions);
	}
}