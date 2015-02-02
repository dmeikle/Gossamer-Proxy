<?php

namespace components\shoppingcart\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;

class CartController extends AbstractController
{
    
    public function add() {
       
        $result = $this->model->add();
        
        $this->render($result);        
    }

    public function remove() {
        $result = $this->model->remove();
        
        $this->render($result);
    }

    public function checkout() {
        $result = $this->model->checkout();
        
       $this->render(array('form' => $this->drawForm($this->model, $result))); 
    }

    public function verify() {
        $result = $this->model->verify();
        
        $this->render($result);
    }

    public function confirm() {
        $result = $this->model->confirm();
        
        $this->render($result);
    }

    public function savePurchase() {
        $result = $this->model->savePurchase();
        
        $this->render($result);
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $clientBuilder = new \components\shoppingcart\form\ClientBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        
        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        
        return $clientBuilder->buildForm($builder, $values, $options, $results);        
    }
}
