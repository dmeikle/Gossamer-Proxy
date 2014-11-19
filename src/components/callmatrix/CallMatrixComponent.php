<?php


namespace components\callmatrix;

use core\AbstractComponent;

class CallMatrixComponent extends AbstractComponent
{
        
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }


}
