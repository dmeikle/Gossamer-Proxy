<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\listeners;

use core\eventlisteners\AbstractListener;
use components\customers\models\CustomerModel;

/**
 * LoadCustomerByIdListener
 *
 * @author Dave Meikle
 */
class LoadCustomerByIdListener extends AbstractListener {

    public function on_request_start($params) {

        $userId = intval($this->httpRequest->getQueryParameter('userid'));

        $model = new CustomerModel($this->httpRequest, $this->httpResponse, $this->logger);

        $datasource = $this->getDatasource('components\customers\models\CustomerModel');

        $contact = current($datasource->query('get', $model, 'get', array('id' => intval($userId))));

        $this->httpRequest->setAttribute('Customer', $contact);
        unset($model);
    }

}
