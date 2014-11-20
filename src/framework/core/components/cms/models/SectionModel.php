<?php

namespace core\components\cms\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of SectionModel
 *
 * @author Dave Meikle
 */ 
class SectionModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CmsSection';
        $this->tablename = 'cmssections';        
    }
    
    public function save($id) {
        $data = $this->httpRequest->getPost();
        $data['section']['id'] = intval($id);
        
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $data['section']);
        
        if(!is_array($result) || count($result) ==0) {
            return array('result' => false);
        }
        //$data['section']['id'] = $id;
        return $data;    
    }
    
    public function delete($id) {
        
        $data = array('id' => intval($id));
        
        $result = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $data);
        
        return array('result' => true);
    }
    
    
}