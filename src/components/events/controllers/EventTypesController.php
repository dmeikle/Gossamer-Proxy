<?php

namespace components\events\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\events\form\EventTypeBuilder;
use core\system\Router;

class EventTypesController extends AbstractController
{
    public function edit($id) {
        $values = $this->model->edit($id);
        
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $values)));
    }
    
    
    public function save($id) {
        parent::saveAndRedirect($id, 'admin_event_types_list', array(0,20));
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new EventTypeBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );
        
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
}
