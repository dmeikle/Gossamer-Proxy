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
 * Description of CostCardItemsController
 *
 * @author Dave Meikle
 */
class CostCardItemsController extends AbstractController {

    public function listallByClaim($claimId) {
        $params = array('Claims_id' => $claimId);
        $offset = 0;
        $limit = 500;
        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');
        $this->render($result);
    }

}
