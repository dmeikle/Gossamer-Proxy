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

}
