<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
/**
 * Description of ClaimLocationModel
 *
 * @author Dave Meikle
 */
class ClaimLocationModel extends AbstractModel {
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ClaimLocation';
        $this->tablename = 'claimslocations';
    }
    
    public function saveRoom($locationId, $roomId) {
        $params = $this->httpRequest->getPost();
        

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['rooms']); 

        
        return $data;
    }
    
    public function viewLocation($claimId, $locationId) {
       
        $params = array('Claims_id' => $claimId, 'id' => $locationId);
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params); 
        
        return $data;
    }
    
    public function listLocationsByClaimId($claimId) {
        
        $params = array('Claims_id' => $claimId);
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params); 
        
        return $data;
    }
    
}
