<?php

namespace components\messaging\listeners;

use core\eventlisteners\AbstractListener;
use components\messaging\models\DiscussionModel;


/**
 * this will verify that someone trying to view a discussion is in fact
 * part of the discussion. it will raise an error if an 'outsider' is
 * trying to view a discussion they are not part of
 *
 * @author davem
 */
class VerifyDiscussionAccessListener extends AbstractListener{
    
    
    public function on_request_start($params) {
       
       
       $model = new DiscussionModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $params = array('Contacts_id'=> $this->getLoggedInStaffId());

       $datasource = $this->getDatasource('components\messaging\models\DiscussionModel');
       
       $result = $datasource->query('get', $model, 'validateDiscussionAccess', $params);
       
       pr($result);
       die;
    }
}
