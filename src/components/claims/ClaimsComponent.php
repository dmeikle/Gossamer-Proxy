<?php


namespace components\claims;

use core\AbstractComponent;

class ClaimsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
