<?php


namespace components\workperformed;

use core\AbstractComponent;

class WorkPerformedComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
