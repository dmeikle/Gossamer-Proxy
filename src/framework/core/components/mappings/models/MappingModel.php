<?php

namespace core\components\mappings\models;

use core\AbstractModel;
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;

/**
 * Description of MappingModel
 *
 * @author davem
 */
class MappingModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);        
        $this->entity = 'Mapping';
        $this->tablename = 'mappings';        
    }
    
}
