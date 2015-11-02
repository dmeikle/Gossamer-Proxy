<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\projects\listeners;

use core\eventlisteners\AbstractListener;
use components\projects\models\ProjectAddressModel;

/**
 * Description of LoadProjectAddressByIdListener
 *
 * @author Dave Meikle
 */
class LoadProjectAddressByIdListener extends AbstractListener {

    public function on_request_start($params = array()) {
        $params = $this->httpRequest->getParameters();

        $datasource = $this->getDatasource('components\\projects\\models\\ProjectAddressModel');
        $model = new ProjectAddressModel($this->httpRequest, $this->httpResponse, $this->logger);
        $claim = $this->httpRequest->getAttribute('Claim');
        $data = array('id' => $claim['ProjectAddresses_id']);
        // $params = array('jobNumber' => , 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');

        $result = $datasource->query('get', $model, 'get', $data);

        if (is_array($result) && array_key_exists('ProjectAddress', $result)) {

            $this->httpResponse->setAttribute('ProjectAddress', current($result['ProjectAddress']));
        }
    }

}
