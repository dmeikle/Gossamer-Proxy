<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\controllers;

use core\AbstractController;

/**
 * Description of InventoryController
 *
 * @author Dave Meikle
 */
class InventoryController extends AbstractController {
    public function search() {

        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }
    
    public function listall($offset = 0, $limit = 20) {
        $offset = intval($offset);
        $limit = intval($limit);
        
        $this->render($this->model->listallWithParams($offset, $limit, array(), 'list'));
    }
}
