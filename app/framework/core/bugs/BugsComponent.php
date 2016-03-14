<?php

namespace core\components\bugs;

use core\AbstractComponent;

class BugsComponent extends AbstractComponent {

    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }

}
