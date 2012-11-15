<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Martin
 * Date: 13.11.12
 * Time: 22:09
 * To change this template use File | Settings | File Templates.
 */
class i18nEnum extends Enum {

	function getEnum(){
		return $this->enum;
	}

	function enumValues($namespace = 'Enum',$hasEmpty = false){
		$translatedOptions = array();

		$options = ($hasEmpty) ? array_merge(array('' => ''), $this->enum) : $this->enum;

		if (!empty($options)) {
			foreach ($options as $value) {
				$translatedOptions[$value] = _t("$namespace.$value", $value);
			}
		}
		return $translatedOptions;
	}

}
