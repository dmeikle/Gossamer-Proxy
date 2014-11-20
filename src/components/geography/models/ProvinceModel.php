<?php

namespace components\geography\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;


/**
 * Description of DiscussionModel
 *
 * @author davem
 */
class ProvinceModel extends AbstractModel{
    
    
     public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Province';
        $this->tablename = 'provinces';
    }
    
    
    
}
