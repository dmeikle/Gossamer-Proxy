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

use core\components\caching\eventlisteners\AbstractCachableListener;
use components\staff\models\StaffModel;

/**
 * ListStaffByRolesListener
 *
 * @author Dave Meikle
 */
class ListStaffByRolesListener extends AbstractCachableListener {

    public function on_request_start($event) {

        $staffAuthorizationModel = new StaffModel($this->httpRequest, $this->httpResponse, $this->logger);

        $role = $this->listenerConfig['role'];

        $datasource = $this->getDatasource('components\staff\models\StaffModel');

        $rawResult = $datasource->query('get', $staffAuthorizationModel, 'listbyroles', array('roles' => $role));
        if (array_key_exists('Staff', $rawResult)) {
            $this->httpResponse->setAttribute('Staff', current($rawResult));
        } else {
            $this->httpResponse->setAttribute('Staff', array());
        }
    }

}
