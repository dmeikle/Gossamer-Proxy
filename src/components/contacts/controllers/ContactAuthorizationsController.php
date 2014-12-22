<?php

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use core\system\Router;
use components\contacts\form\ContactAuthorizationBuilder;
use core\eventlisteners\Event;


class ContactAuthorizationsController extends AbstractController
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
    
    public function savePermissions($id) {
        $result = $this->model->savePermissions($id);
     
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_contacts_permissions_get', array($id));
        
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
       
        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        
        return $contactBuilder->buildForm($builder, $values, $options, $results);        
    }
    
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function editCredentials($id) {
     
        $result = $this->model->load($id);        
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
       
        $result['contactTypes'] = $contactTypes;                
        $result['form'] = $this->drawCredentialsForm($this->model,  $result);
      
        $this->render($result);
    } 
    
    public function saveCredentials($id) {
        
       $result = $this->model->saveCredentials($id);
        
        //update the local user settings
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $result));
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_contacts_permissions_get', array($id));
     
    }
    
     protected function drawCredentialsForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $contactAuthorizationBuilder = new ContactAuthorizationBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
      
        $options = array();
        return $contactAuthorizationBuilder->buildCredentialsForm($builder, $values, $options, $results);
    }
    
    public function unlock($id) {
        $this->model->unlock($id);
        
        $this->render();
    }
    
    public function viewCredentials() {
        $this->editCredentials($this->model->getLoggedInStaffId());
    }
    
    public function portalSaveCredentials() {
        
        $result = $this->model->saveCredentials($this->model->getLoggedInStaffId());
        
        //update the local user settings
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $result));
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('portal_contact_settings', array($id));
    }
}
