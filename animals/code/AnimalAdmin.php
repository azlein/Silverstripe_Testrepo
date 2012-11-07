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
	static $url_segment = 'animals';

	function canAdd($member=null) {
		return false;
	}


}
