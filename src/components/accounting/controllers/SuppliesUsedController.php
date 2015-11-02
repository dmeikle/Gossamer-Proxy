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
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class SuppliesUsedController extends AbstractController {

    public function listBreakdown($suppliesUsedId) {
        $offset = 0;
        $limit = 20;
        $params = array(
            'SuppliesUsed_id' => intval($suppliesUsedId)
        );

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'breakdown');

        $this->render($result);
    }

    public function search() {

        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }

}
