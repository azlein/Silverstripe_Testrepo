<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Azadeh
 * Date: 06.10.12
 * Time: 11:37
 * To change this template use File | Settings | File Templates.
 */

    class MyImages extends DataObject {
        static $db = array(
          'Title' => 'Text'
        );
        static $has_one = array(
            'Galerie'=>'GaleriePage',
            'Image' => 'Image'
        );

        public function getCMSFields() {
            $fields = new FieldList();

            $fields->push(new TextField('Title', 'Titel des Bildes'));
            $f = new UploadField('Image', 'Bild');
            $fields->push($f);
            return $fields;
        }
    }

    class GaleriePage extends Page {
        static $has_many = array(
            'Images'=>'MyImages'
        );

        public function getCMSFields(){
            $fields = parent::getCMSFields();
            $config = GridFieldConfig_RelationEditor::create();

            $f = new GridField('Images', 'Bilder der Galerie', $this->Images(), $config);
            $config->addComponent(new GridFieldBulkEditingTools());
            $config->addComponent(new GridFieldBulkImageUpload());
            $fields->addFieldToTab("Root.Images",$f);
            return $fields;
        }
    }

    class GaleriePage_Controller extends Page_Controller{
    }
?>