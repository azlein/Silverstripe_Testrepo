<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 25.10.12
 * Time: 20:11
 * To change this template use File | Settings | File Templates.
 */


class Animal extends DataObject {
	static $db = array(
		'Name'=>'Varchar',
		'Gender'=>'Varchar',
		'Description'=>'HtmlText',
		'Contact'=>'Text',
		'Race'=>'Text',
		'Color'=>'Text',
        'Injection'=>'Text',
		'BirthDate'=>'Date'

	);

	public static $has_one = array(
		'Category'=>'Category',
		'ProfilePic'=>'Image',
		'Created_by'=>'Member'
	);

	static $many_many = array(
		'OtherPics'=>'Image'
	);

	static $summary_fields = array(
		'ID'=>'ID',
		'Name' => 'Animal Name',
		'BirthDate'=>'BirthDate',
		'Contact' => 'Contact',
		'Category.Name' => 'Category',
		'Race'=>'Race' ,
		'Color'=>'Color',
		'Created_by.Surname' => 'Created by',
        'Injection'=>'Injection'
	);

	static $searchable_fields = array(
		'Name' => array(
			'field' => 'TextField',
			'filter' => 'PartialMatchFilter',
		),
		'CategoryID',
		'Contact',
		'Race' => array(
			'field' => 'TextField',
			'filter' => 'PartialMatchFilter',
		),
		'Created_by.Surname',
        'Injection'=>array(
            'field'=>'TextField',
            'filter'=>'PartialMatchFilter'
        )
	);

	function translateAgeUnit($AgeUnit){
		return _t("Enum.$AgeUnit");
	}

	function getAge(){
		$born = $this->obj('BirthDate');

		$d = $born->TimeDiffIn('days');
		if (intval($d) == 1)
			return str_replace('day', _t('Date.DAY','day'), $d);
		if(intval($d)<31)
			return str_replace('days',_t('Date.DAYS','days'), $d);

		$m = $born->TimeDiffIn('months');
		if (intval($m) == 1)
			return str_replace('month',_t('Date.MONTH','month'),$m);
		if(intval($m)<13)
			return str_replace('months',_t('Date.MONTHS','months'),$m);

		$y = $born->TimeDiffIn('years');
		if (intval($y) == 1)
			return str_replace('years',_t('Date.YEAR', 'year'),$y);

		return str_replace('years', _t('Date.YEARS','years'), $y);
	}

	function i18n_singular_name() {
		$name = $this->singular_name();
		return _t('Animals.SINGULAR_NAME', $name);
	}

	function i18n_plural_name() {
		$name = $this->plural_name();
		return _t('Animals.PLURAL_NAME',$name);
	}

    function fieldLabels($includerelations = true){
        $labels = parent::fieldLabels($includerelations);

		$labels['Name'] = _t('Animals.NAME','Name');
	    $labels['AgeUnit'] = _t('Animals.AGE_UNIT','Unit');
        $labels['Contact'] = _t('Animals.CONTACT','Contact');
        $labels['CategoryID'] = _t('Animals.CATEGORY','Category');
        $labels['Created_by.Surname'] = _t('Animals.CREATEDBY','Created by');
		$labels['ProfilePic'] = _t('Animals.PROFILEPIC','Profilepic');
		$labels['Race'] =_t('Animals.RACE','Race') ;
		$labels['Color'] = _t('Animals.COLOR','Color');
        $labels['Injection'] = _t('Animals.INJECTION','Injection');
		$labels['BirthDate'] = _t('Animals.BIRTHDATE','Date of Birth');
        return $labels;
    }

	function getCMSFields() {
		$fields =new FieldList();
		$fields->push(new TextField('Name',_t('Animals.NAME','Name')));

		$DateField = new Datefield('BirthDate',_t('Animals.BIRTHDATE','Date of Birth'));
	    $DateField->setConfig('showcalendar', true);

		$DateField->setLocale('en_GB');

		$fields->push($DateField);


		$fields->push(new DropdownField('Gender',_t('Animals.GENDER','Gender'), array(_t('Animals.MALE','Male')=>_t('Animals.MALE','Male'),
																					  _t('Animals.FEMALE','Female')=>_t('Animals.FEMALE','Female'))));

		$f =  new DropdownField('CategoryID',_t('Animals.CATEGORY','Category'), Category::get()->map('ID', 'Name'));
		$f->setEmptyString(_t('AnimalSearchForm.EMPTY_SELECTION', 'No selection'));
		$f->setHasEmptyDefault(true);
		$fields->push($f);

        $fields->push(new TextField('Injection',_t('Animals.INJECTION','Injection')));

		$fields->push(new TextField('Race',_t('Animals.RACE','Race'))) ;
		$fields->push(new TextField('Color',_t('Animals.COLOR','Color')));
		$fields->push(new HtmlEditorField('Description',_t('Animals.DESCRIPTION','Description')));
		$fields->push(new TextField('Contact',_t('Animals.CONTACT','Contact')));

		$fields->push($if = new UploadField('ProfilePic',_t('Animals.PROFILEPIC','Profilepic')));
		$if->setConfig('allowedMaxFileNumber', 1)->setFolderName('animals/thumbnails');
		$if->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));

		//$f =new UploadField('ProfilePic',_t('Animals.PROFILEPIC','Profilepic'));
		//$f->setConfig('allowedMaxFileNumber',1);
		//$f->getValidator()->setAllowedExtensions(File::$app_categories['image']);
		//$fields->push($f);

		$f2 = new UploadField('OtherPics',_t('Animals.IMAGESUPLOAD','Images Upload'));
		$f2->getValidator()->setAllowedExtensions(File::$app_categories['image']);
		$fields->push($f2);

		return $fields;
	}


	//TextField für Name,Des,Race nicht leer sein
	function getCMSValidator(){
		return new RequiredFields('Name','Description','Race', 'CategoryID');
	}

	function onBeforeWrite(){
		if($this->record['Created_byID'] == 0) {
			$this->record['Created_byID'] = Member::currentUserID();
		}
		parent::onBeforeWrite();
	}

	function validate() {
		$result = parent::validate();
		if(!Permission::check('MANAGE_ANIMAL'))
			$result->error(_t('Animals.NO_PERMISSION', "You don't have the rights to do so"));
		return $result;
	}

	function canCreate($member=null){
		if(Permission::check('MANAGE_ANIMAL'))
			return true;

		return false;
	}

	function canDelete($member=null){
		if(Permission::check('MANAGE_ANIMAL'))
			return true;
		return false;
	}

	function canEdit($member=null){
		if(Permission::check('MANAGE_ANIMAL'))
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
			'MANAGE_ANIMAL'=> array(
				'name' => _t('Animals.PERMISSION_MANAGE_ANIMAL', 'User can manage an animal'),
				'category' => _t('AnimalAdmin.PERMISSION_CATEGORY','AnimalAdmin Admin Rights'),
				'help' => _t('Animals.PERMISSION_MANAGE_ANIMAL', 'User can manage an animal'),
				'sort' => 0
			)
		);
	}
}
