<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;


use core\eventlisteners\AbstractListener;
use components\claims\models\ClaimModel;


/**
 * Description of UploadLocationPhotosListener
 *
 * @author Dave Meikle
 */
class LoadClaimByJobNumberListener extends AbstractListener{
    
    public function on_request_start($params = array()) {
        $params = $this->httpRequest->getParameters();
        
        $datasource = $this->getDatasource('components\\claims\\models\\ClaimModel');
        $model = new ClaimModel($this->httpRequest, $this->httpResponse, $this->logger);
        $data = array('jobNumber' => $params[0]);
       // $params = array('jobNumber' => , 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');
        
        $result = $datasource->query('get', $model, 'get', $data);
        if(is_array($result) && array_key_exists('Claim', $result)) {
            $this->httpRequest->setAttribute('Claim', current($result['Claim']));
        }        
        
    }
   
}
