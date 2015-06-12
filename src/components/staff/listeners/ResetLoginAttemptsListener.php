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
use core\eventlisteners\Event;

/**
 * Description of ResetLoginAttemptsListener
 *
 * @author Dave Meikle
 */
class ResetLoginAttemptsListener extends AbstractListener {

    public function on_login_success(Event $event) {
        $params = $event->getParams();
        $model = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($model);
        $client = $params['client'];
        $data = array('Staff_id' => $client->getId(),
            'failedLogins' => '0');
       // $params = array('jobNumber' => , 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');
    
        $result = $datasource->query('post', $model, 'save', $data);
        
    }
        
        
}
