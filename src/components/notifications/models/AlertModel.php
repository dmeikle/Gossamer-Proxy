<?php

namespace components\notifications\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of PropertyModel
 *
 * @author davem
 */
class AlertModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Alert';
        $this->tablename = 'alerts';
    }
    
    public function search() {
        $params = array('keywords' => $this->httpRequest->getPost());
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
      
        return $this->formatResults($data['Alerts']);
    }
}
