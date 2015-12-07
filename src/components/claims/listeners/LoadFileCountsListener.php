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

use components\claims\models\ClaimModel;

/**
 * LoadFileCountsListener
 *
 * @author Dave Meikle
 */
class LoadFileCountsListener extends \core\eventlisteners\AbstractListener {

    public function on_request_start($params) {

        $path = __UPLOADED_FILES_PATH . 'claims' . DIRECTORY_SEPARATOR . $this->getClaimId() . DIRECTORY_SEPARATOR;
        $locations = $this->getClaimLocations();


        $folderList = array('list' => array());
        $totalFiles = 0;
        foreach ($locations as $claimLocationId => $unit) {
            if (file_exists($path . $claimLocationId)) {
                $folderList['list'][$claimLocationId]['count'] = iterator_count(new \DirectoryIterator($path . $claimLocationId)) - 2; //remove . and ..
            } else {
                $folderList['list'][$claimLocationId]['count'] = 0; //nothing uploaded yet
            }
        }

        $this->httpResponse->setAttribute('folderList', $folderList);
    }

    private function getClaimLocations() {

        $datasource = $this->getDatasource('components\\claims\\models\\ClaimModel');
        $model = new ClaimModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = array('Claims_id' => $this->getClaimId());

        return $this->formatUnitNumbers($datasource->query('get', $model, 'getunitnumbers', $params));
    }

    private function getClaimId() {
        $params = $this->httpRequest->getParameters('Claims_id');

        return intval($params[0]);
    }

    private function formatUnitNumbers(array $units) {
        $retval = array();
        foreach ($units['unitNumbers'] as $unit) {
            $retval[$unit['id']] = $unit['unitNumber'];
        }
        return $retval;
    }

}
