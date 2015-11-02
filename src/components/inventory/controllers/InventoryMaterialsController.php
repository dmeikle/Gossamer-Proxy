<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\controllers;

class InventoryMaterialsController extends InventoryItemsController {

    public function listAllMaterials($offset = 0, $limit = 20) {
        $queryParams = $this->httpRequest->getQueryParameters();
        $params = array('InventoryTypes_id' => 1);
        if (array_key_exists('Vendors_id', $queryParams)) {
            $params['Vendors_id'] = intval($queryParams['Vendors_id']);
        }
        $results = $this->model->listallWithParams($offset, $limit, $params);

        $this->renderResults($offset, $limit, $results);
    }

}
