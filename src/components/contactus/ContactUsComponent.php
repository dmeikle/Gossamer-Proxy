<?php


namespace components\contactus;

use core\AbstractComponent;

class ContactUsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
