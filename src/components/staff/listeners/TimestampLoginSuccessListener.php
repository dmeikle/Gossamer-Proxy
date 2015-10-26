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
use components\staff\models\AccessLogModel;
use core\eventlisteners\Event;

/**
 * Description of TimestampLoginSuccessListener
 *
 * @author Dave Meikle
 */
class TimestampLoginSuccessListener extends AbstractListener {

    public function on_login_success(Event &$event) {
        $params = $event->getParams();

        $retval = array();
        $model = new AccessLogModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array('Staff_id' => $params['client']->getId(), 'ipAddress' => $params['client']->getIpAddress());

        $datasource = $this->getDatasource('components\staff\models\AccessLogModel');

        $result = $datasource->query('post', $model, 'save', $params);
    }

}
