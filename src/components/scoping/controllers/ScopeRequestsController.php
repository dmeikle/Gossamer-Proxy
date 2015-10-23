<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scoping\controllers;

use core\AbstractController;

class ScopeRequestsController extends AbstractController {

    public function saveContact($id) {
        $result = $this->model->saveContact($id);

        $this->render($result);
    }

    public function loadContact($id) {
        $result = $this->model->loadContact($id);

        $this->render($result);
    }

    public function getTakeoff($id) {
        $result = $this->model->getTakeoff($id);

        $this->render($result);
    }

}
