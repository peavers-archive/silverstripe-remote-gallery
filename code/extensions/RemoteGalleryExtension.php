<?php

/**
 * Class RemoteGalleryExtension.php
 * @package: remote-gallery
 */
class RemoteGalleryExtension extends DataExtension
{
    private static $db = array(
        'FilePath'     => 'Varchar(255)',
        'RemotePrefix' => 'Varchar(255)',
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab("Root.GallerySettings", array(
            TextField::create("RemotePrefix", "Prefix the remote URL")
                ->setDescription("Useful if you have a CloudFront URL for example"),
        ));
    }

}
