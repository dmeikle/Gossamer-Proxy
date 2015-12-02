<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\vendors\controllers;

use core\AbstractController;

class VendorLocationsController extends AbstractController {

    public function listallLocations($vendorId, $offset, $limit) {
        $params = array('Vendors_id' => intval($vendorId));

        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        $this->render($result);
    }

}