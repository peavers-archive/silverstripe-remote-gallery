<?php

/**
 * Class RemoteImage
 */
class RemoteImage extends DataObject
{
    private static $db = array(
        'Title'       => 'Varchar(255)',
        'Description' => 'Text',
        'RemoteLink'  => 'Text',
    );

    private static $has_one = array(
        'GalleryPage'    => 'GalleryPage',
        'ThumbnailImage' => 'Image',
    );

    private static $many_many = array(
        'ImageTag' => 'ImageTag',
    );

    private static $summary_fields = array(
        'Thumbnail'     => 'Thumbnail',
        'Title'         => 'Title',
        'Description'   => 'Description',
        'getSummaryTag' => 'Tags',
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab("Root.Main", array(
            TextField::create("RemoteLink", "Remote link")
                ->setAttribute("placeholder", "http://example.com/image.jpg")
                ->setDescription("<strong>Note: </strong>The url must end with an image extension such as .jpg, .png, .gif")
        ));

        $fields->removeByName('GalleryPageID');
        $fields->removeByName('ThumbnailImage');

        return $fields;
    }

    /**
     * Thumbnail for the summary gridview
     *
     * @return string
     */
    public function getThumbnail()
    {
        if ($Image = $this->ThumbnailImage()->ID) {
            return $this->ThumbnailImage()->CMSThumbnail();
        } else {
            return '(No Image)';
        }
    }

    /**
     * Used in the summary field of the gridview to show a list of tags
     *
     * @return null|string
     */
    public function getSummaryTag()
    {
        $stringList = null;
        $counter = 0;

        foreach ($this->ImageTag() as $object) {
            if ($counter >= 1) {
                $stringList .= ", ";
            }
            $stringList .= (string)$object->Title;
            $counter++;
        }

        return $stringList;
    }

    /**
     * Used in the template to create filter categories
     *
     * @return ArrayList
     */
    public function getTag()
    {
        $arrayList = new ArrayList();
        foreach ($this->ImageTag() as $object) {
            $arrayList->add($object);
        }

        return $arrayList;
    }

    /**
     * 1. Fetch the image from the remote URL
     * 2. Crop the image to 136x136 as per the frontend design
     * 3. Create an image object and save the relationship to this object
     *
     * Over complicated and needs to be refactored at some point, but not today.
     *
     */
    public function onBeforeWrite()
    {
        // Fetch the image based on the
        $url = $this->RemoteLink;
        $filename = mt_rand(10000, 999999) . "." . strtolower(pathinfo($url, PATHINFO_EXTENSION));
        $img = ASSETS_PATH . '/cache/' . $filename;

        // Confirm the download is successful
        if (!file_put_contents($img, file_get_contents($url))) {
            user_error("Issue downloading file from internet", E_USER_WARNING);
        }

        // Resize downloaded image
        $backend = Injector::inst()->createWithArgs(Image::get_backend(), array($img));
        $newBackend = $backend->croppedResize(136, 136);
        $newBackend->writeTo($img);

        // Create and save image object
        $folderToSave = 'assets/cache/';
        $folderObject = DataObject::get_one("Folder", "`Filename` = '{$folderToSave}'");
        $thumbnailObject = Object::create('Image');
        $thumbnailObject->ParentID = $folderObject->ID;
        $thumbnailObject->Name = $filename;
        $thumbnailObject->OwnerID = (Member::currentUser() ? Member::currentUser()->ID : 0);
        $thumbnailObject->write();
        $this->ThumbnailImageID = DataObject::get_one('Image', "`Name` = '{$filename}'")->ID;

        parent::onBeforeWrite();
    }
}
