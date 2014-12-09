<?php


namespace components\companies;

use core\AbstractComponent;

class CompaniesComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
