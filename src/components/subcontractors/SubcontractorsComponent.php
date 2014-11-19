<?php


namespace components\subcontractors;

use core\AbstractComponent;

class SubcontractorsComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
