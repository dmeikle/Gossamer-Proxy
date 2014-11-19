<?php

namespace components\geography;

use core\AbstractComponent;

/**
 * Description of GeographyComponent
 *
 * @author davem
 */
class GeographyComponent extends AbstractComponent{
   
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }

}
