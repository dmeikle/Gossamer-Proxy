<?php


namespace components\surveys\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;


/**
 * Description of ScopingFormModel
 *
 * @author davem
 */
class SurveyModel extends AbstractModel implements FormBuilderInterface{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Survey';
        $this->tablename = 'surveys';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();        
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        return $data;
    }

}
