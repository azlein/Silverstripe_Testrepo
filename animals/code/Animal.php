<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 25.10.12
 * Time: 20:11
 * To change this template use File | Settings | File Templates.
 */

class Animal extends DataObject{
	static $db = array(
		'Name'=>'Varchar',
		'Age'=>'Int',
		'Gender'=>'Varchar',
		'Description'=>'HtmlText',
		'Contact'=>'Text',
		'Race'=>'Text'
		//Farbe
	);

	static $has_one = array(
		'Category'=>'Category',
		'ProfilePic'=>'Image',
		'Created_by'=>'Member'
	);

	static $many_many = array(
		'OtherPics'=>'Image'
	);

	static $summary_fields = array(
		'Name' => 'Animal Name',
		'Age' => 'Age',
		'Contact' => 'Contact',
		'Category.Name' => 'Category',
		'Race'=>'Race' ,
		'Created_by.Surname' => 'Created by'
	);

	static $searchable_fields = array(
		'Name',
		'Category.Name',
		'Contact',
		'Race',
		'Created_by.Surname'
	);

    function fieldLabels($includerelations = true){
        $labels = parent::fieldLabels($includerelations);
        $labels['Name'] = _t('Animals.NAME','Name');
        $labels['Age'] = _t('Animals.AGE','Age');
        $labels['Contact'] = _t('Animals.CONTACT','Contact');
        $labels['Category.Name'] = _t('Animals.CATEGORY','Category');
        $labels['Created_by.Surname'] = _t('Animals.CREATEDBY','Created by');
		$labels['ProfilePic'] = _t('Animals.PROFILEPIC','Profilepic');
		$labels['Race'] =_t('Animals.RACE','Race') ;
        return $labels;
    }

	function getCMSFields() {
		$fields = new FieldList();
		$fields->push(new TextField('Name',_t('Animals.NAME','Name')));
		$fields->push(new NumericField('Age',_t('Animals.AGE','Age')));
		$fields->push(new DropdownField('Gender',_t('Animals.GENDER','Gender'), array(_t('Animals.MALE','Male'),_t('Animals.FEMALE','Female'))));
		$fields->push(new DropdownField('CategoryID',_t('Animals.CATEGORY','Category'), Category::get()->map('ID', 'Name')));
		$fields->push(new TextField('Race',_t('Animals.RACE','Race'))) ;
		$fields->push(new HtmlEditorField('Description',_t('Animals.DESCRIPTION','Description')));
		$fields->push(new TextField('Contact',_t('Animals.CONTACT','Contact')));



		$f =new UploadField('ProfilePic',_t('Animals.PROFILEPIC','Profilepic'));
		$f->setConfig('allowedMaxFileNumber',1);
		//$f->getValidator()->setAllowedExtentions(array('jpg','jpeg', 'png','gif'));
		$f->getValidator()->setAllowedExtensions(File::$app_categories['image']);


		$fields->push($f);

		//@TODO übersetzen plus evntl. bessere Lösung finden
		$config = GridFieldConfig_RelationEditor::create();
		$f = new GridField('OtherPics', 'Bilder der Galeries', $this->OtherPics(), $config);
		$config->addComponent(new GridFieldBulkEditingTools());
		$config->addComponent(new GridFieldBulkImageUpload());

		$fields->push($f);

		return $fields;
	}


	function onBeforeWrite(){
		if($this->record['Created_byID'] == 0) {
			$this->record['Created_byID'] = Member::currentUserID();
		}
		parent::onBeforeWrite();
	}

	function canCreate($member=null){
		/**if(Permission::check('CREATE_ANIMAL'))
			return true; **/
		return false;
	}

	function canDelete($member=null){
		if(Member::currentUserID()==$this->Created_by()->ID)
			return true;
		return false;
	}

	function canEdit($member=null){
		if(Member::currentUserID()==$this->Created_by()->ID)
			return true;
		return false;
	}

	function canView($member=null) {
		return true;
	}

}

class Animal_Controller extends ContentController implements PermissionProvider {

	/**
	 * Return a map of permission codes to add to the dropdown shown in the Security section of the CMS.
	 * array(
	 *   'VIEW_SITE' => 'View the site',
	 * );
	 */
	function providePermissions(){
		return array(
			'CREATE_ANIMAL'=> array(
				'name' => _t('Animals.PERMISSION_CREATE_ANIMAL', 'User can create an animal'),
				'category' => _t('AnimalAdmin.PERMISSION_CATEGORY','AnimalAdmin Admin Rights'),
				'help' => _t('Animals.PERMISSION_CREATE_ANIMAL', 'User can create an animal'),
				'sort' => 0
			)
		);
	}
}
