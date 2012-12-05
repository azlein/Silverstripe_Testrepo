<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 28.11.12
 * Time: 16:39
 * To change this template use File | Settings | File Templates.
 */
class NewsArticle extends Page{

	public static $allowed_children = array();
	public static $icon = 'news/images/notepad_18.png';

	public static $db = array(
		'Author'=>'Varchar',
		'Date'=>'Date',
		'Source'=>'Varchar(255)',
		'ExternalUrl'=>'Text',
		'Summary'=>'Text'
	);

	public static $has_one = array(
		'Thumbnail'=>'Image',
		'InternalFile'=>'File'
	);

	function fieldLabels($includerelations = true){
		$labels = parent::fieldLabels($includerelations);

		$labels['Content'] = _t('NewsArticle.CONTENT','Content');

		return $labels;
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$authorField = new TextField('Author',_t('NewsArticle.AUTHOR','Author'));
		$fields->addFieldToTab('Root.Main',$authorField,'Content');

		$fields->addFieldToTab('Root.Main',$d = new DateField('Date',_t('NewsArticle.DATE','Date')),'Content');
		$d->setConfig('showcalendar',true);

		$fields->addFieldToTab('Root.Main',new TextField('Source',_t('NewsArticle.SOURCE','Source (Text)')),'Content');
		$fields->addFieldToTab('Root.Main',new TextField('ExternalUrl',_t('NewsArticle.EXTERNAL','Source (Text)')),'Content');
		$fields->addFieldToTab('Root.Main',$s = new TextareaField('Summary',_t('NewsArticle.SUMMARY','Summary')),'Content');

		return $fields;
	}

	public function populateDefaults() {
		//$this->Author = Member::currentUser()->getName();
		$this->Date = date('Y-m-d');
	}

	public function getUrlForRedirect() {
		return $this->ExternalUrl;
	}
}

class NewsArticle_Controller extends Page_Controller{
	public function init() {
		parent::init();
		Requirements::css('news/css/NewsArticle.css');
	}

	public function redirectToExternal() {
		return $this->redirect($this->getUrlForRedirect());
	}

}