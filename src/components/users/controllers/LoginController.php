<?php

namespace components\users\controllers;

use core\AbstractController;

class LoginController extends AbstractController
{
    public function login() {
      
        $this->model->login();
        $this->render(array('title' => 'login', 'pageTitle' => ''));
    }
}
