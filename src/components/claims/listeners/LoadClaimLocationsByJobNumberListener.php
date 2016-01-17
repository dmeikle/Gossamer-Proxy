<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;

use core\eventlisteners\AbstractListener;
use components\claims\models\ClaimLocationModel;

/**
 * Description of LoadClaimLocationsByClaimIdListener
 *
 * @author Dave Meikle
 */
class LoadClaimLocationsByJobNumberListener extends AbstractListener {

    public function on_request_start($params = array()) {
        $params = $this->httpRequest->getParameters();
pr($params);
die;
        $datasource = $this->getDatasource('components\\claims\\models\\ClaimLocationModel');
        $model = new ClaimLocationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $claim = $this->httpRequest->getAttribute('Claim');
        $data = array('jobNumber' => $claim['id']);
        // $params = array('jobNumber' => , 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');

        $result = $datasource->query('get', $model, 'get', $data);

        if (is_array($result) && array_key_exists('ClaimsLocation', $result)) {

            $this->httpResponse->setAttribute('ClaimsLocation', $result['ClaimsLocation']);
        }
    }

    public function on_filerender_start($params = array()) {
        $params = $this->httpRequest->getParameters();

        $datasource = $this->getDatasource('components\\claims\\models\\ClaimLocationModel');
        $model = new ClaimLocationModel($this->httpRequest, $this->httpResponse, $this->logger);

        $data = array('Claims_id' => $this->getClaimId());
        // $params = array('jobNumber' => , 'directive::ORDER_BY' => 'id', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50');

        $result = $datasource->query('get', $model, 'list', $data);

        if (is_array($result) && array_key_exists('ClaimsLocations', $result)) {

            $this->httpRequest->setAttribute('ClaimsLocations', $result['ClaimsLocations']);
        }
    }

    private function getClaimId() {
        return intval($this->httpRequest->getQueryParameter('Claims_id'));
    }

}
