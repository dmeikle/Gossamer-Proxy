<?php


namespace components\incidents;

use core\AbstractComponent;

class IncidentsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
