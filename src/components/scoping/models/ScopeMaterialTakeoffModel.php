<?php

namespace components\scoping\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ScopeMaterialTakeoffModel extends  AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ScopeMaterialTakeoff';
        $this->tablename = 'scopeMaterialTakeoffs';        
    }

    public function getTakeoff($id) {
        
        return array();
    }
}
