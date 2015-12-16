<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\documents\listeners;

use components\claims\models\ClaimDocumentModel;

/**
 * LoadDocumentsCountsListener
 *
 * @author Dave Meikle
 */
class LoadDocumentsCountsListener extends \core\eventlisteners\AbstractListener {

    public function on_request_start($params) {

        $path = __UPLOADED_FILES_PATH . 'documents' . DIRECTORY_SEPARATOR . $this->getClaimId() . DIRECTORY_SEPARATOR;
        $count = $this->getDocumentCount();


//        $folderList = array('list' => array());
//        foreach ($locations as $claimLocationId => $unit) {
//            if (file_exists($path . $claimLocationId)) {
//                $folderList['list'][$claimLocationId]['count'] = iterator_count(new \DirectoryIterator($path . $claimLocationId)) - 2; //remove . and ..
//            } else {
//                $folderList['list'][$claimLocationId]['count'] = 0; //nothing uploaded yet
//            }
//        }

        $this->httpResponse->setAttribute('documentCount', $count);
    }

    private function getDocumentCount() {

        $datasource = $this->getDatasource('components\\claims\\models\\ClaimDocumentModel');
        $model = new ClaimDocumentModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = array('Claims_id' => $this->getClaimId());

        $count = $datasource->query('get', $model, 'list', $params);
        if (array_key_exists('ClaimDocumentsCount', $count)) {
            return $count['ClaimDocumentsCount'][0]['rowCount'];
        }
    }

    private function getClaimId() {
        $params = $this->httpRequest->getParameters('Claims_id');

        return intval($params[0]);
    }

}
