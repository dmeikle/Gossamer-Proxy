<?php


namespace components\fileuploads;

use core\AbstractComponent;

class FileUploadsComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
