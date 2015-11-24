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

use core\AbstractController;
use core\serialization\Serializer;

class VendorItemsController extends AbstractController {

    public function listbyItem($itemId) {
        $offset = 0;
        $limit = 50;

        $params = array('InventoryItems_id' => intval($itemId));

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'list');
        $serializer = new Serializer();
        $serializer->formatEntityIds($result['VendorItems'], $this->model);

        $this->render($result);
    }

}
