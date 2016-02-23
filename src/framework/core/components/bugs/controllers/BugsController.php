<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\bugs\controllers;

use core\AbstractController;

/**
 * BugsController
 *
 * @author Dave Meikle
 */
class BugsController extends AbstractController {

    public function listallReverse($offset = 0, $limit = 20) {
        $result = $this->model->listallReverse($offset, $limit);
        $this->render($result);
    }

}
