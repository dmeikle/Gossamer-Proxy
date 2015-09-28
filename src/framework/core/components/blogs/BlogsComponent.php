<?php


namespace core\components\blogs;

use core\AbstractComponent;

class BlogsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }

}
