<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 25.10.12
 * Time: 20:29
 * To change this template use File | Settings | File Templates.
 */

class Category extends DataObject{
	static $db = array(
		'Name'=>'Varchar'
	);
	static $has_many = array(
		'Animals'=>'Animal'
	);

	function validate() {
		$result = parent::validate();
		if(!Permission::check('MANAGE_CATEGORY'))
			$result->error(_t('Category.NO_PERMISSION', "You don't have the rights to do so"));
		return $result;
	}
	function i18n_singular_name(){
		$name = $this->singular_name();
		return _t('Category.SINGULAR_NAME',$name);
	}
	function i18n_plural_name(){
		$name = $this->plural_name();
		return _t('Category.PLURAL_NAME',$name);
	}

     function canCreate(){
        if(Permission::check('MANAGE_CATEGORY'))
            return true;
		return false;
    }

    function canDelete(){
        if(Permission::check('MANAGE_CATEGORY'))
            return true;
		return false;
	}
    function canEdit(){
        if(Permission::check('MANAGE_CATEGORY'))
            return true;
		return false;
    }

    function canView() {
		return true;
    }
}
class Category_Controller extends ContentController implements PermissionProvider {

    /**
     * Return a map of permission codes to add to the dropdown shown in the Security section of the CMS.
     * array(
     *   'VIEW_SITE' => 'View the site',
     * );
     */
    function providePermissions() {
        return array(
            'MANAGE_CATEGORY'=>array(
                'name'=> _t('Category.PERMISSION_MANAGE_CATEGORY','User can manage Categories'),
                'category'=>_t('AnimalAdmin.PERMISSION_CATEGORY','Animal Admin Rights'),
                'help' => _t('Category.PERMISSION_MANAGE_CATEGORY', 'User can manage a Category'),
				'sort' => 0
            )
        );
    }
}
