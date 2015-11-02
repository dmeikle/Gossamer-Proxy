<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\users\controllers;

use core\AbstractController;

class LoginController extends AbstractController {

    public function login() {

        $this->model->login();
        $this->render(array('title' => 'login', 'pageTitle' => ''));
    }

}
