<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 25.10.12
 * Time: 20:46
 * To change this template use File | Settings | File Templates.
 */
class AnimalAdmin extends ModelAdmin {
	public static $managed_models = array(
		'Animal',
		'Category'
	);
	static $model_importers = array();
	static $url_segment = 'animals';

	public function getManagedModelTabs(){
		$tabs = parent::getManagedModelTabs();
		if (!Permission::check('MANAGE_CATEGORY'))
			$tabs->remove($tabs->last());
		return $tabs;
	}


}
