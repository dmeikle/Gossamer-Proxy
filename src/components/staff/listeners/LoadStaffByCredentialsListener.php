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
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadStaffByCredentialsListener extends AbstractListener {

    public function on_request_start($params) {

        $model = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);

        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        try {
            $result = $datasource->query('get', $model, 'get', $params[$model->getEntity()]);
            if (array_key_exists('StaffAuthorization', $result)) {
                $staffAuthorization = (current($result['StaffAuthorization']));
                $this->httpRequest->setAttribute('StaffAuthorization', $staffAuthorization);
            }
        } catch (\Exception $e) {

        }
    }

}
