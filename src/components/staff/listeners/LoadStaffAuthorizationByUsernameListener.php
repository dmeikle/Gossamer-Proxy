<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use components\staff\models\StaffAuthorizationModel;

/**
 * LoadStaffAuthorizationByUsernameListener
 *
 * @author Dave Meikle
 */
class LoadStaffAuthorizationByUsernameListener extends AbstractListener {
    
    public function on_request_start($params) {
        $params = $this->httpRequest->getPost();
        $model = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        
        $datasource = $this->getDatasource($model);
        $result = $datasource->query('get', $model, 'get', $params);
        if(array_key_exists('StaffAuthorization', $result)) {
            $this->httpRequest->setAttribute('StaffAuthorization', current($result['StaffAuthorization']));
        }
    }
}
