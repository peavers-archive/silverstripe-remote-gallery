<?php

/**
 * Class ImageTag
 */
class ImageTag extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Label' => 'Varchar(255)',
    );

    private static $belongs_many_many = array(
        'RemoteImage' => 'RemoteImage'
    );

    private static $summary_fields = array(
        'Label' => 'Tag name'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab("Root.Main", array(
            TextField::create("Title", "Tag"),
            TextField::create("Label", "Label")->setDescription("Label on the button for filtering tags")
        ));

        return $fields;
    }

    public function onBeforeWrite()
    {
        $safeTitle = $this->Title;
        $safeTitle = urlencode($safeTitle);
        $safeTitle = strtolower($safeTitle);
        $this->Title = $safeTitle;

        parent::onBeforeWrite();
    }
}
