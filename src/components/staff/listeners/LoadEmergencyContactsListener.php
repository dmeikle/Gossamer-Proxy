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
use core\eventlisteners\Event;
use components\staff\models\StaffEmergencyContactModel;

/**
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadEmergencyContactsListener extends AbstractListener {

    public function on_request_start($params) {

        $model = new StaffEmergencyContactModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = $this->httpRequest->getParameters();

        $datasource = $this->getDatasource('components\staff\models\StaffEmergencyContactModel');

        $staff = current($datasource->query('get', $model, 'list', array('Staff_id' => intval($params[0]))));

        unset($model);

        $this->httpResponse->setAttribute('emergencyContacts', $staff);
    }

}
