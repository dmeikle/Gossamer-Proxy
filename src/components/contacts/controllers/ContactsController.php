<?php

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use core\system\Router;


class ContactsController extends AbstractController
{
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);
        
         if(is_array($result) && array_key_exists('Contact', $result)) {
            $contact = $result['Contact'];  
            $result['form'] = $this->drawForm($this->model, $contact);
        } else {
             $result['form'] = $this->drawForm($this->model, array());
        }
        
        $this->render($result);
    }
      
    /**
    * save - saves/updates row
    * 
    * @param int id    primary key of item to save
    */
    public function save($id) {

       $result = $this->model->save($id);

       $this->render($result);
    }

    
    public function view() {
        $result = $this->model->view();
        
        $this->render($result);        
    }
    
    public function contactsSearchResults() {
        $results = $this->httpRequest->getAttribute('Contacts');
       
        if(is_array($results)) {
            $serializer = new ContactSerializer();
            $results = $serializer->formatContactSearchResults($results);
        } else {
            $results = array();
        }     
        
        $this->render($results);
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $contactBuilder = new ContactBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        
       
        //$provinceList = $this->httpRequest->getAttribute('Provinces');
       
//        $serializer = new ProvinceSerializer();
//        $selectedOptions = array($contactBuilder->getValue('Provinces_id', $values));
        
       // $options = array('provinces' => $serializer->formatSelectionBoxOptions($serializer->pruneList($provinceList), $selectedOptions));
        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        return $contactBuilder->buildForm($builder, $values, $options, $results);
        
    }
}
