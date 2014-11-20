<?php

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;

class ContactsController extends AbstractController
{
    public function savePermissions($id) {
        $result = $this->model->savePermissions($id);
        
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
}
