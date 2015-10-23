<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\companies\listeners;

use core\eventlisteners\AbstractCachableListener;
use components\companies\models\CompanyModel;

/**
 * LoadCompanyByIdListener
 *
 * @author Dave Meikle
 */
class LoadCompanyByIdListener extends AbstractCachableListener {

    public function on_response_start($event) {

        $params = $event->getParams();


        $datasource = $this->getDatasource('components\\companies\\models\\CompanyModel');
        $model = new CompanyModel($this->httpRequest, $this->httpResponse, $this->logger);

        $contact = $params['Contact'][0];
        $data = array('id' => $contact['Companies_id']);

        $result = $datasource->query('get', $model, 'get', $data);

        if (is_array($result) && array_key_exists('Company', $result)) {

            $this->httpResponse->setAttribute('Company', current($result['Company']));
        }
    }

    protected function getKey($event = null) {
        $params = $event->getParams();
        $contact = $params['Contact'][0];

        return 'Companies_' . $contact['Companies_id'];
    }

    /**
     * gets the parameters either from the uri or from yml
     *
     * @return array
     */
    protected function getParameters() {
        $configParams = (array_key_exists('params', $this->listenerConfig) ? $this->listenerConfig['params'] : array());

        if (array_key_exists('type', $configParams)) {
            if ($configParams['type'] == 'uri') {
                return $this->httpRequest->getParameters();
            }
        }

        return $configParams;
    }

}
