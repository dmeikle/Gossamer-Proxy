<?php


namespace components\staff;

use core\AbstractComponent;

class StaffComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
    }
}
