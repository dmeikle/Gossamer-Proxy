<?php


namespace components\surveys;

use core\AbstractComponent;

class SurveysComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
