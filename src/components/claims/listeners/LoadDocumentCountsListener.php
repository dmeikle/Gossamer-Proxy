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
use components\claims\models\ClaimDocumentModel;

/**
 * LoadDocumentCountsListener
 *
 * @author Dave Meikle
 */
class LoadDocumentCountsListener extends \core\eventlisteners\AbstractListener {

    public function on_request_start($params) {
        $documents = $this->getClaimDocuments();

        $this->httpResponse->setAttribute('documentList', $documents);
    }

    private function getClaimDocuments() {

        $datasource = $this->getDatasource('components\\claims\\models\\ClaimModel');
        $model = new ClaimDocumentModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = array('Claims_id' => $this->getClaimId());

        return $datasource->query('get', $model, 'list', $params);
    }

    private function getClaimId() {
        $params = $this->httpRequest->getParameters('Claims_id');

        return intval($params[0]);
    }

}
