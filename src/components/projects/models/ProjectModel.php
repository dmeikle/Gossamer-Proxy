<?php

namespace components\projects\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\eventlisteners\Event;


/**
 * Description of PropertyModel
 *
 * @author davem
 */
class ProjectModel extends AbstractModel implements FormBuilderInterface{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Project';
        $this->tablename = 'projects';
    }
    
    /*
     * might need to redo tables structure on this - rather than assign a single adjuster,
     * need to assign a company to it where multiple adjusters can access...
     * this function is a work in progress- not completed
     */
    public function listallByContactType($offset, $limit, $contactId) {         
        
        $params = array(
            'PropertyManager_id' => $contactId,
            'InsuranceAdjuster_id' => $contactId,
            'PropertyManager_id' => $contactId,
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, array('ProjectAddresses_id' => intval($id)));
       
        return $data;
    }
    
    public function listallByCompany($offset, $limit, $companyId) {
        $params = array('companyId' => $companyId,
            'DIRECTIVE::OFFSET' => $offset,
            'DIRECTIVE::LIMIT' => $limit);
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByCompany', $params);
       echo 'here';
        return $data;
    }
    
    public function editFloorPlan($projectId, $floorPlanId) {
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, array('ProjectAddresses_id' => $projectId, 'id' => intval($floorPlanId))); 
        
        return $data;
    }

    public function remove($projectId, $floorPlanId) {
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, array('ProjectAddresses_id' => $projectId, 'id' => intval($floorPlanId))); 
         
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'delete_success', new Event('delete_success', $data));   
    }
    
    public function getFormWrapper() {
        return $this->entity;
    }

}
