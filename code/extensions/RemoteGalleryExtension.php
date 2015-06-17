<?php

/**
 * Class RemoteGalleryExtension.php
 * @package: remote-gallery
 */
class RemoteGalleryExtension extends DataExtension
{
    private static $db = array(
        'FilePath' => 'Varchar(255)'
    );

    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldsToTab("Root.GallerySettings", array(
            TextField::create("FilePath", "File path")
                ->setAttribute("placeholder", "/assets/Uploads/cache")
                ->setDescription("Path to where the cache folder is located"),
        ));

    }

}
