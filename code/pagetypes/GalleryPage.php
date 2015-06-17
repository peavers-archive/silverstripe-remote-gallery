<?php

/**
 * Class GalleryPage
 */
class GalleryPage extends Page
{
    private static $singular_name = "[Remote Gallery] Gallery page";

    private static $plural_name = "[Remote Gallery] Gallery pages";

    private static $description = "Remote Gallery Holds a collection of images";

    private static $icon = 'remote-gallery/images/icons/sitetree_images/holder.png';

    public $pageIcon = 'images/icons/sitetree_images/holder.png';

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

        Requirements::css("remote-gallery/css/style.css");

        Requirements::javascript("remote-gallery/js/lib/jquery.min.js");
        Requirements::javascript("remote-gallery/js/lib/jquery.fancybox.js");
        Requirements::javascript("remote-gallery/js/lib/jquery.mixitup.min.js");
        Requirements::javascript("remote-gallery/js/functions.js");
    }

    public function getImageTag()
    {
        return ImageTag::get()->sort('Title', 'ASC');
    }

    public function getThumbnailImage()
    {
        return RemoteImage::get()->sort('Created', 'DESC');
    }

}
