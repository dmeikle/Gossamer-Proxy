<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;

/**
 * Description of ClaimLocationCommentsController
 *
 * @author Dave Meikle
 */
class ClaimLocationCommentsController extends AbstractController {

    public function listCommentsByJobnumber($jobNumber) {
        $params = array('jobNumber' => $jobNumber);

        $this->render($this->model->listCommentsByJobnumber($params));
    }


}
