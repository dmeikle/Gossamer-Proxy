<?php


namespace components\messaging;

use core\AbstractComponent;

class MessagingComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
