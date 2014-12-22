<?php

namespace components\events\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

class EventContactModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'EventContact';
        $this->tablename = 'eventcontacts';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        if(!isset($params[$this->entity]['isActive'])) {
            $params[$this->entity]['isActive'] = '0';
        }
        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);        
    }
}
