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
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of SecondarySheetsController
 *
 * @author Dave Meikle
 */
class SecondarySheetsController extends AbstractController {

    public function listAllResponsesBySheetId($claimId, $locationId, $sheetId) {
        $offset = 0;
        $limit = 100; //there happens to be exactly 100 possible questions

        $params = array('Claims_id' => intval($claimId), 'ClaimsLocations_id' => intval($locationId), 'AffectedAreasSecondarySheets_id' => intval($sheetId));

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'listCurrentResponses');

        $this->render($result);
    }

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
        $form = $this->drawForm($this->model, $result);

        $serializer = new \components\claims\serialization\SecondarySheetSerializer();

        $this->render(array('Actions' => $serializer->serializeQuestions($form), 'Claims_id' => intval($claimId), 'ClaimsLocations_id' => intval($locationId), 'AffectedAreas_id' => intval($areaId), 'SecondarySheets_id' => intval($sheetId)));
    }

    protected function drawForm(\Gossamer\CMS\Forms\FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $sheetBuilder = new \components\claims\form\SecondaryJobSheetBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();
        //needed because builder will re-instantiate on each item (custom)
        $sheetBuilder->setModel($model);

        return $sheetBuilder->buildForm($builder, $values, $options, $results);
    }

}
