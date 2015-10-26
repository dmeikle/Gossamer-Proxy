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
use components\staff\models\StaffModel;

/**
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadStaffByIdListener extends AbstractListener {

    public function on_load_complete(Event $event) {

        $model = new StaffModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = $event->getParams();

        $datasource = $this->getDatasource('components\staff\models\StaffModel');

        $staff = current($datasource->query('get', $model, 'get', array('id' => $params['Author_id'])));
        $params['staff'] = $staff;
        $event->setParams($params);
        unset($model);
    }

    public function on_request_start($params) {

        $model = new StaffModel($this->httpRequest, $this->httpResponse, $this->logger);

        $staffId = ($this->httpRequest->getQueryParameter('staffid'));

        $datasource = $this->getDatasource('components\staff\models\StaffModel');

        $staff = current($datasource->query('get', $model, 'get', array('id' => $staffId)));

        unset($model);
        $this->httpRequest->setAttribute('Staff', $staff);
    }

}
