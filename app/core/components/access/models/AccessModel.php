<?php

namespace core\components\access\models;

use core\AbstractModel;

/**
 * Description of AccessModel
 *
 * @author davem
 */
class AccessModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Staff';
        $this->tablename = 'staff';        
    }
    
}
