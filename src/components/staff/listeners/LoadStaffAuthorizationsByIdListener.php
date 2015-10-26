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
use components\staff\models\StaffAuthorizationModel;

/**
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadStaffAuthorizationsByIdListener extends AbstractListener {

    public function on_request_start($params) {

        $staffAuthorizationModel = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();

        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');

        $rawResult = $datasource->query('get', $staffAuthorizationModel, 'get', array('Staff_id' => intval($params[0])));

        if (is_array($rawResult) && array_key_exists('StaffAuthorization', $rawResult)) {
            $this->httpRequest->setAttribute('StaffAuthorization', $rawResult);
            $this->httpResponse->setAttribute('StaffAuthorization', $rawResult['StaffAuthorization'][0]);
        }
    }

}
