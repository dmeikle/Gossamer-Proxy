<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\subcontractors\controllers;

use core\AbstractController;

class ClaimLocationSubcontractorController extends AbstractController {

    public function listallClaims($id, $offset, $limit) {
        $params = array('id' => intval($id));
        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        $this->render($result);
    }

}
