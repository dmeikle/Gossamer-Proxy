<?php

namespace components\contacts\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ContactTypeModel extends  AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ContactType';
        $this->tablename = 'contacttypes';        
    }
    
}
