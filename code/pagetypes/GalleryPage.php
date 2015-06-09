<?php

/**
 * Class GalleryPage
 */
class GalleryPage extends Page
{
    private static $has_many = array(
        'RemoteImage' => 'RemoteImage'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab("Root.Images", array(
            GridField::create('RemoteImage', 'Images', $this->RemoteImage(), GridFieldConfig_RecordEditor::create()),
        ));

        return $fields;
    }

}

/**
 * Class GalleryPage_Controller
 */
class GalleryPage_Controller extends Page_Controller
{

    public function init()
    {
        parent::init();

        Requirements::css("gallery/css/style.css");

        Requirements::javascript("gallery/js/lib/jquery.min.js");
        Requirements::javascript("gallery/js/lib/jquery.fancybox.js");
        Requirements::javascript("gallery/js/lib/jquery.mixitup.min.js");
        Requirements::javascript("gallery/js/functions.js");
    }

    public function getImageTag()
    {
        return ImageTag::get()->sort('Created', 'ASC');
    }

}
