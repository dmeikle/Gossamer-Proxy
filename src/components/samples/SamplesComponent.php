<?php


namespace components\samples;

use core\AbstractComponent;

class SamplesComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
