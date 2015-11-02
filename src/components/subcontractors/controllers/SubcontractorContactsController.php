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

class SubcontractorContactsController extends AbstractController {

    public function listallById($id) {
        $result = $this->model->listallById($id);

        $this->render($result);
    }

}
