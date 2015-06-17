<?php

/**
 * Class ImageTagAdmin
 */
class ImageTagAdmin extends ModelAdmin
{
    private static $managed_models = array(
        'ImageTag',
    );

    private static $url_segment = 'tags';

    private static $menu_title = 'Image Tags';

    public function subsiteCMSShowInMenu()
    {
        return true;
    }

}
