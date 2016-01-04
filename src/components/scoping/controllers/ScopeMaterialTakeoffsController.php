<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scoping\controllers;

use core\AbstractController;
use core\eventlisteners\Event;

class ScopeMaterialTakeoffsController extends AbstractController {

    public function editByLocation($claimsId, $claimsLocationsId) {
        //$results = $this->model->editByLocation($claimsId, $claimsLocationsId);
        $results = array('Claims_id' => intval($claimsId), 'ClaimsLocations_id' => intval($claimsLocationsId));

        $this->render($results);
    }

    public function getByLocation($claimsId, $claimsLocationsId) {
        $results = $this->model->editByLocation($claimsId, $claimsLocationsId, 0);
        if (array_key_exists('ScopingMaterialTakeoffSheet', $results)) {
            if (array_key_exists('ScopingMaterialTakeoffSheetItem', $results['ScopingMaterialTakeoffSheet'][0])) {
                $serializer = new \components\scoping\serialization\MaterialTakeoffSheetSerializer();
                $areaTypes = $results['AreaTypes'];
                $id = $results['ScopingMaterialTakeoffSheet'][0]['id'];
                $areas = $results['ScopingMaterialTakeoffSheet'][0]['ScopingMaterialTakeoffSheetItem'];

                $results = $serializer->formatAreaTypes($results['AreaTypes'], $areas);
                $results['AreaTypes'] = $areaTypes;
                $results['id'] = $id;

//                pr($results);
            }
        }


        //$results = array('Claims_id' => intval($claimsId), 'ClaimsLocations_id' => intval($claimsLocationsId));

        $this->render($results);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save

      public function save($id) {

      $result = $this->model->save($id);

      $params = array('entity' => $this->model->getEntity(true), 'result' => $result, 'id' => $id);
      $event = new Event('save_success', $params);
      $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', $event);

      $areaTypes = $this->httpRequest->getAttribute('AreaTypes');
      $serializer = new \components\scoping\serialization\MaterialTakeoffSheetSerializer();
      $result = $serializer->formatAreaTypesRaw($areaTypes, $result);

      $this->render($result);
      }
     */
}
