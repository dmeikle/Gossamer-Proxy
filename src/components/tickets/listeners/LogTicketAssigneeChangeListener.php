<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\tickets\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\tickets\models\TicketAssigneeModel;

/**
 * LogTicketAssigneeChangeListener
 *
 * @author Dave Meikle
 */
class LogTicketAssigneeChangeListener extends AbstractListener {
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
        
        $model = new TicketAssigneeModel($this->httpRequest, $this->httpResponse, $this->logger);

        $datasource = $this->getDatasource('components\tickets\models\TicketAssigneeModel');

        $staff = current($datasource->query('post', $model, 'save', $params));
        
        unset($model);
    }
}
