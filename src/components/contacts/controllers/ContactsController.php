<?php

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use components\contacts\form\ContactDisplayBuilder;
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
        
        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);
        
        //$contactTypes = $this->httpRequest->getAttribute('ContactTypes'); -pasted in for when this is a loaded list
       
        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list
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
       $router = new Router($this->logger, $this->httpRequest);
       $router->redirect('admin_contacts_permissions_get' , array($id));
    }

    
    public function view() {
        $result = $this->model->view();
       
        $this->render(array('form' => $this->drawDisplay($this->model, $result['Contact'])));        
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
        
        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        
        return $contactBuilder->buildForm($builder, $values, $options, $results);        
    }
    
    protected function drawDisplay(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $displayBuilder = new ContactDisplayBuilder();
        
        
        return $displayBuilder->buildForm($builder, $values);   
    }
    
    
    public function load() {
        $result = $this->model->view();
       
        $this->render(array('form' => $this->drawForm($this->model, $result['Contact'])));    
    }
    
    public function saveInfo() {
        $result = $this->model->save($this->model->getLoggedInStaffId());
       
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('portal_contact_settings');
    }
    
    public function listallByFriendId($offset, $limit) {
        $filter = array(
            'Contacts_id' => $this->model->getLoggedInStaffId()
        );
        
        $results = $this->model->listallWithParams($offset, $limit, $filter);
        
        $this->render($results);
    }
    
    public function findByEmail() {
        $params = $this->httpRequest->getPost();
        $result = $this->model->findByEmail($params['email']);
        
        $this->render($result);
    }
    
}
