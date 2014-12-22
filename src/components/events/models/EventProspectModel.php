<?php

namespace components\events\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;


class EventProspectModel extends  AbstractModel implements FormBuilderInterface
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'EventProspect';
        $this->tablename = 'eventprospects';        
    }
    
    public function listAllByEventId($id, $offset, $limit) {
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'Events_id' => intval($id), 'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit
        );
        
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        
        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);        
    }
}
