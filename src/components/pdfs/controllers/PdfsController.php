<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\pdfs\controllers;

use core\AbstractController;

/**
 * Description of PdfsController
 *
 * @author Dave Meikle
 */
class PdfsController extends AbstractController {

    public function get($id) {
        $data = $this->model->get($id);

        $this->render($data);
    }

}
