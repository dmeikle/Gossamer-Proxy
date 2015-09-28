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
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contacts\form\ContactBuilder;
use core\system\Router;


class NotificationSettingsController extends AbstractController
{
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
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
       $router = new Router($this->logger, $this->httpRequest);
       $router->redirect('admin_contacts_permissions_get' , array($id));
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
}
