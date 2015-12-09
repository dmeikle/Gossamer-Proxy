<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;

/**
 * Description of SecondarySheetsController
 *
 * @author Dave Meikle
 */
class SecondarySheetsController extends AbstractController {

    public function listAllByLocation($claimId, $claimLocationId) {
        $offset = 0;
        $limit = 100;
        $params = array('Claims_id' => intval($claimId), 'ClaimsLocations_id' => intval($claimLocationId));

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'list');

        $this->render($result);
    }

    public function loadByLocation($claimId, $claimLocationId, $sheetId) {
        $offset = 0;
        $limit = 1;
        $params = array('Claims_id' => intval($claimId), 'ClaimsLocations_id' => intval($claimLocationId), 'AffectedAreasSecondarySheets_id' => intval($sheetId));

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'list');

        $this->render($result);
    }

    public function listallActions($claimId, $claimsLocationsId, $affectedAreasId) {
        $offset = 0;
        $limit = 100;
        $params = array();

        $result = $this->model->listallWithParams($offset, $limit, $params, 'listquestions');

        $this->render($result);
    }

    public function loadSheet($claimId, $locationId, $areaId, $sheetId) {
        $params = array(
            'Claims_id' => intval($claimId),
            'ClaimsLocations_id' => intval($locationId),
            'AffectedAreas_id' => intval($areaId),
            'SecondarySheets_id' => intval($sheetId)
        );

        $result = $this->model->listallWithParams(0, 1, $params, 'get');
        $serializer = new \components\claims\serialization\SecondarySheetSerializer();

        $this->render(array('Actions' => $serializer->serializeQuestions($result)));
    }

}
