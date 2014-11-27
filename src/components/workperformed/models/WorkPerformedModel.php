<?php

namespace components\workperformed\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

class WorkPerformedModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ActionPerformed';
        $this->tablename = 'actionperformed';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function save($id) {
        
        $params = $this->httpRequest->getPost();
      
        $params['ActionPerformed']['id'] = intval($id);
             
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['ActionPerformed']);  

        return $data;
    }
}
