<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\controllers;

use core\AbstractController;
use components\contacts\serialization\ContactSerializer;
use components\contacts\serialization\ContactTypeSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use components\contacts\form\ContactDisplayBuilder;
use core\system\Router;
use core\eventlisteners\Event;

class ContactsController extends AbstractController
{
    
    public function search() {        
        $result = $this->httpRequest->getAttribute($this->getSearchKey());
       
        if(!is_array($result)) {
            $result = $this->model->search($this->httpRequest->getQueryParameters());
            $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'load_success', new Event('load_success', $result));
        }        
        
        $this->render($result);
    }
    
    /**
     * get - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function get($id) {
        $result = $this->model->edit($id);
        
        
        $this->render($result);
    }
      
    /**
    * save - saves/updates row
    * 
    * @param int id    primary key of item to save
    */
    public function save($id) {

       $result = $this->model->save($id);
     pr($result);
     pr($result['Contact']);
     pr($result['Contact']['id']);
       $router = new Router($this->logger, $this->httpRequest);
       $router->redirect('admin_contacts_credentials_get' , array($result['Contact']['id']));
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
        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $contactTypeSerializer = new ContactTypeSerializer();
        $contactTypesList = $contactTypeSerializer->formatContactTypesList($contactTypes, $values);
        unset($contactTypeSerializer);
        
        $options = array(
            'companies' => array(),
            'contactTypes' => $contactTypesList
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
