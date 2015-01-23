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
 * Description of LocationsPhotos
 *
 * @author Dave Meikle
 */
class LocationsPhotoModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'LocationsPhoto';
        $this->tablename = 'locationsPhotos';
    }
    
    
    public function saveClaimsLocationPhotos($claimId, $locationId) {
        $client = $this->getClient();
        $parms =$this->httpRequest->getParameters();
      
        $images = $this->httpRequest->getAttribute('uploadedFiles');
        
        foreach($images as $image) {
            $this->saveImage( $parms[1], $image, $client->getId());
        }
        
        return array();
    }
    
    private function saveImage($locationId, $filename, $clientId) {
       $params = array('ClaimsLocations_id' => $locationId,
            'Staff_id' => $clientId,
            'photo' => $filename
        );
       
        $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);        
    }
    
    private function getClient() {
        $token = $this->getSecurityToken();
        
        return $token->getClient();
    }
}
