<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;

class LoginController extends AbstractController {

    public function login() {

        $this->render(array('title' => 'login', 'pageTitle' => '', 'form' => $this->drawForm($this->model)));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = NULL) {
        $builder = new FormBuilder($this->logger);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder->addValidationResults($results);
        $builder->add('email', 'text', array('class' => 'form-control'))
                ->add('password', 'password', array('class' => 'form-control'))
                ->add('submit', 'submit', array('value' => 'LOGIN_SIGNIN', 'class' => 'btn btn-primary'));

        return $builder->getForm();
    }

    public function rolesNotSet() {
        $this->render(array('title' => 'login', 'pageTitle' => '', 'error' => 'LOGIN_ROLES_NOT_SET'));
    }

    public function view() {
        $this->render(array('title' => 'login', 'pageTitle' => ''));
    }

}
