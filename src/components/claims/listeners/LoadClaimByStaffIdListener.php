<?php

namespace components\claims\listeners;


use core\eventlisteners\AbstractListener;
use components\claims\models\ClaimModel;


/**
 * Description of UploadLocationPhotosListener
 *
 * @author davem
 */
class LoadClaimByStaffIdListener extends AbstractListener{
    
    public function on_request_start($params = array()) {
        
        $datasource = $this->getDatasource('components\\claims\\models\\ClaimModel');
        $model = new ClaimModel($this->httpRequest, $this->httpResponse, $this->logger);
        
        $params = array('Staff_id' => $this->getLoggedInStaffId(), 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');
        
        $result = $datasource->query('get', $model, 'listClaimsByStaff', $params);
        if(array_key_exists('Claims', $result)) {
            $this->httpRequest->setAttribute('claimsList', $result['Claims']);
        } else {
            $this->httpRequest->setAttribute('claimsList', array());
        }
        
    }
   
}
