<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\widgets\controllers;

use core\AbstractController;

/**
 * WidgetsController
 *
 * @author Dave Meikle
 */
class WidgetsSystemController extends AbstractController {

    public function index() {
        $result = $this->model->listall(0, 20);

        $this->render($result);
    }

}
