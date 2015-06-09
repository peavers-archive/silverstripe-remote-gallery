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

    public function onBeforeWrite()
    {
        $safeTitle = $this->Title;
        $safeTitle = urlencode($safeTitle);
        $safeTitle = strtolower($safeTitle);
        $this->Title = $safeTitle;

        parent::onBeforeWrite();
    }
}
