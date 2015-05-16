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
use components\tickets\models\TicketCommentModel;

/**
 * LoadTicketCommentsListener
 *
 * @author Dave Meikle
 */
class LoadTicketCommentsListener extends AbstractListener {
    
    public function on_request_start($params) {
        $params = $this->httpRequest->getParameters();
       
        $ticketId = intval($params[0]);
       
        $conn = $this->getDatasource('components\tickets\models\TicketCommentModel');
       
        $model = new TicketCommentModel($this->httpRequest, $this->httpResponse, $this->logger);

        $comments = $conn->query('get', $model, 'list', array('Tickets_id' => $ticketId));
        if(!is_array($comments) || !array_key_exists('TicketComments', $comments)) {
            return;
        }
        $this->httpResponse->setAttribute('TicketComments', $comments['TicketComments']);        
        $this->httpResponse->setAttribute('TicketCommentsCount', $comments['TicketCommentsCount']);
    }
}
