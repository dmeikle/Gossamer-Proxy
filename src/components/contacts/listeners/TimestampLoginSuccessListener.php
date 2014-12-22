<?php

namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use components\staff\models\AccessLogModel;
use core\eventlisteners\Event;

/**
 * Description of TimestampLoginSuccessListener
 *
 * @author davem
 */
class TimestampLoginSuccessListener  extends AbstractListener{
    
   
    
    public function on_login_success(Event &$event) {
        $params = $event->getParams();
        
       $retval = array();
       $model = new AccessLogModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $params = array('Contacts_id'=> $params['client']->getId(), 'ipAddress' => $params['client']->getIpAddress());

       $datasource = $this->getDatasource('components\contacts\models\AccessLogModel');
       
       $result = $datasource->query('post', $model, 'save', $params);

    }
    
    
}