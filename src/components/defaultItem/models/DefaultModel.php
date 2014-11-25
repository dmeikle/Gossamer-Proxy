<?php

namespace components\defaultItem\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;


class DefaultModel extends  AbstractModel
{
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Default';
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
        $params = array(
            'offset' => $offset, 'rows' => $rows
        );
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        $data['Products'] = $this->httpRequest->getAttribute('Products');
        
        $this->render($data);
    }
    
     public function index(array $params) {  
         
        return $params;
    }
    
    
}
