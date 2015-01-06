<?php

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use components\contacts\form\ContactInviteBuilder;
use core\system\Router;


class ContactInvitesController extends AbstractController
{
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);
         
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
      
    /**
    * save - saves/updates row
    * 
    * @param int id    primary key of item to save
    */
    public function save($id) {

       $result = $this->model->save($id);
       $router = new Router($this->logger, $this->httpRequest);
       $router->redirect('portal_contact_invites_list' , array(0, 20));
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
        $contactBuilder = new ContactInviteBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        return $contactBuilder->buildForm($builder, $values, $options, $results);
        
    }
    
    public function listall($offset = 0, $limit = 0) {
        $filter = array(
            'InviterContacts_id' => $this->model->getLoggedInStaffId()
        );
        
        $results = $this->model->listallWithParams($offset, $limit, $filter);
       
        $this->render($results);
    }
      
    
    public function invite() {
        $this->render(array('form' => $this->drawForm($this->model, array())));
    }
}
