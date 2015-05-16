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


class InventoryEquipmentController extends InventoryItemsController {


    
    public function listAllEquipment($offset = 0, $limit = 20) {
        $results = $this->model->listallWithParams($offset, $limit, array('InventoryTypes_id' => 2));
        
        $this->renderResults($offset, $limit, $results);
    }
}
