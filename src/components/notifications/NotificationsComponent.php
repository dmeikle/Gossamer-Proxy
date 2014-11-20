<?php


namespace components\notifications;

use core\AbstractComponent;

class NotificationsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
