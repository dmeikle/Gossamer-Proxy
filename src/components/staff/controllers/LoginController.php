<?php

namespace components\staff\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;


class LoginController extends AbstractController
{
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
}
