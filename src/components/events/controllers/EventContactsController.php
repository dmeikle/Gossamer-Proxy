<?php

namespace components\events\controllers;

use core\AbstractController;
use components\events\form\ContactBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;

class EventContactsController extends AbstractController
{
    public function edit($id) {
        $result = $this->model->edit($id);
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
    
    public function save($id) {
        parent::saveAndRedirect($id, 'admin_event_contacts_list', array(0,20));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new ContactBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));
        
        $options = array();

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
}
