<?php


namespace components\cms;

use core\AbstractComponent;

class CmsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
