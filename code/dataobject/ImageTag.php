<?php

/**
 * Class ImageTag
 */
class ImageTag extends DataObject implements PermissionProvider
{
    private static $db = array(
        'Title'    => 'Varchar(255)',
        'Label'    => 'Varchar(255)',
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

    //
    // Permission providers
    //
    public function canEdit($member = null)
    {
        return Permission::check('REMOTE_GALLERY_TAGS_EDIT');
    }

    public function canDelete($member = null)
    {
        return Permission::check('REMOTE_GALLERY_TAGS_DELETE');
    }

    public function canCreate($member = null)
    {
        return Permission::check('REMOTE_GALLERY_TAGS_CREATE');
    }

    public function canView($member = null)
    {
        return true;
    }

    public function providePermissions()
    {
        return array(
            'REMOTE_GALLERY_TAGS_EDIT'   => array(
                'name'     => 'Edit remote gallery tags',
                'category' => 'Remote Gallery permissions'
            ),

            'REMOTE_GALLERY_TAGS_DELETE' => array(
                'name'     => 'Delete remote gallery tags',
                'category' => 'Remote Gallery permissions'
            ),

            'REMOTE_GALLERY_TAGS_CREATE' => array(
                'name'     => 'Create remote gallery tags',
                'category' => 'Remote Gallery permissions'
            ),
        );
    }


}
