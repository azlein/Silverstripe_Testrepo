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

    function canCreate(){
        if(Permission::check('CREATE_CATEGORY'))
            return true;
    }

    function canDelete(){
        if(Permission::check('CREATE_CATEGORY'))
            return true;
    }
    function canEdit(){
        if(Permission::check('CREATE_CATEGORY'))
            return true;
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
            'CREATE_CATEGORY'=>array(
                'name'=> _t('Category.PERMISSION_CREATE_CATEGORY','User can Categories'),
                'category'=>_t('AnimalAdmin.PERMISSION_CATEGORY','Animal Admin Rights'),
                'help' => _t('Category.PERMISSION_CREATE_CATEGORY', 'User can create a Category'),
				'sort' => 0
            )
        );
    }
}
