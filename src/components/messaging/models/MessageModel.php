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
use Gossamer\CMS\Forms\FormBuilderInterface;


/**
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class MessageModel extends AbstractModel implements FormBuilderInterface {
    
    
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
        $params['Message']['fromStaff_id'] = $this->getLoggedInStaffId();

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveMessage', $params[$this->entity]); 
      
        return $data;
    }
    
    
    public function get(array $params) {
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'viewmessage', $params); 
      
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

    public function getFormWrapper() {
        return $this->entity;
    }
    
    public function getFolderCounts(array $params) {
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listfoldercounts', $params);
        
        return $data;
    }

}
