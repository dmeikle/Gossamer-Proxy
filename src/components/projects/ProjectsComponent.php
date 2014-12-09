<?php


namespace components\projects;

use core\AbstractComponent;

class ProjectsComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
