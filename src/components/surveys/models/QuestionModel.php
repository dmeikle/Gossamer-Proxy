<?php


namespace components\surveys\models;

use core\AbstractModel;

use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\eventlisteners\Event;



/**
 * Description of SheetQuestionModel
 *
 * @author davem
 */

class QuestionModel extends AbstractModel implements FormBuilderInterface{
   
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Question';
        $this->tablename = 'questions';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();        
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $data));
       
        return $data;
    }
    
}
