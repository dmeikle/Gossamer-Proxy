<?php


namespace core\components\locales;

use core\AbstractComponent;

class LocaleComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
