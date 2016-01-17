<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\vehicles\listeners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use components\vehicles\models\VehicleTollModel;

/**
 * LoadVehicleTollsListener
 *
 * @author Dave Meikle
 */
class LoadVehicleTollsListener extends AbstractCachableListener {

    public function on_request_start($params) {

        $model = new VehicleTollModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = $this->httpRequest->getParameters();

        $datasource = $this->getDatasource('components\vehicles\models\VehicleTollModel');

        $tolls = current($datasource->query('get', $model, 'list', array('Vehicle_id' => intval($params[0]))));

        unset($model);

        $this->httpResponse->setAttribute($this->getResponseKey(), $tolls);

        $this->saveValuesToCache($this->getKey(), $tolls);
    }

    protected function getKey($params = null) {
        $params = $this->httpRequest->getParameters();

        return 'VehicleTolls_' . intval($params[0]);
    }

}
