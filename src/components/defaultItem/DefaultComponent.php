<?php


namespace components\defaultItem;

use core\AbstractComponent;

class DefaultComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
