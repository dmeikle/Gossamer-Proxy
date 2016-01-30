<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;

class LoginController extends AbstractController {

    public function login() {

        $this->render(array('title' => 'login', 'pageTitle' => ''));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = NULL) {
        $builder = new FormBuilder($this->logger);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
    }

    public function rolesNotSet() {
        $this->render(array('title' => 'login', 'pageTitle' => '', 'error' => 'LOGIN_ROLES_NOT_SET'));
    }

}
