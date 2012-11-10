<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 09.11.12
 * Time: 11:23
 */
class AnimalSearchForm extends Form{

	public function __construct($controller,$name) {
		$fields = new FieldList(
			  TextField::create('Name','Name')
		);
		$actions = new FieldList(
			FormAction::create("search")->setTitle("Suche")->addExtraClass('btn btn-primary')

		);
		parent::__construct($controller, $name, $fields, $actions);
	}
}