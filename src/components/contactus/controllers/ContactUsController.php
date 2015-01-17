<?php

namespace components\contactus\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contactus\form\ContactUsBuilder;
use components\contactus\serialization\ContactUsTypeSerialization;

class ContactUsController extends AbstractController
{
    public function view() {
        $this->render(array('form' => $this->drawForm($this->model)));
    }
    
    public function save($id) {
        parent::saveAndRedirect(0, 'website_contactus_complete', array());
    }
    
    public function adminView($id) {
        $result = $this->model->edit($id);
        
        $this->render(array('form' => $result));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $contactusBuilder = new ContactUsBuilder();
        
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $contactusTypes = $this->httpRequest->getAttribute('ContactUsTypes');
        
        $serializer = new ContactUsTypeSerialization();
                
        $options = array(
            'companies' => array(),
            'ContactUsTypes' =>$serializer->pruneContactUsTypes($contactusTypes)
        );
        
        
        unset($serializer);
        
        return $contactusBuilder->buildForm($builder, $values, $options, $results);
    }
    
    
}
