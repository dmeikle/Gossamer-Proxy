<?php

namespace components\users\models;

use core\AbstractModel;

class User extends  AbstractModel
{
    public function __construct() {
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
