<?php


namespace components\scheduling;

use core\AbstractComponent;

class SchedulingComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
