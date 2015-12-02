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
 * Description of CostCardsController
 *
 * @author Dave Meikle
 */
class CostCardsController extends AbstractController {

    public function listallByClaim($claimId, $offset, $limit) {
        $params = array('Claims_id' => $claimId);
        $offset = intval($offset);
        $limit = intval($limit);
        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');
        $this->render($result);
    }

}
