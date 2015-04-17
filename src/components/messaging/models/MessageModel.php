<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;



/**
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class MessageModel extends AbstractModel {
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Message';
        $this->tablename = 'messages';
    }
    
    public function search(array $term) {
        $params = array('keywords' => $this->httpRequest->getPost());
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
      
        return $this->formatResults($data['Alerts']);
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params['message']['fromStaff_id'] = $this->getLoggedInStaffId();
        if(intval($params['discussion']['ClaimsLocations_id']) < 1) {
            unset($params['discussion']['ClaimsLocations_id']);
        }
       
        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveMessage', $params); 
      
        return $data;
    }
    
    public function create($claimId, $locationId, $discussionId) {
      
        $params = array(
            'Claims_id' => intval($claimId),
            'ClaimsLocations_id' => intval($locationId),
            'MessagingDiscussions_id' => intval($discussionId)
        );     
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['claimId'] = intval($claimId);
        $data['locationId'] = intval($locationId);
        $data['discussionId'] = intval($discussionId);
        
        return $data;
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
        
        $data = parent::listall($offset, $rows);
        
        $data['claimId'] = 0;
        $data['locationId'] = 0;
        
        return $data;
    }
    
    
}
