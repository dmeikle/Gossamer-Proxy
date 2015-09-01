<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\geography\serialization\ProvinceSerializer;
use components\staff\form\StaffAuthorizationBuilder;
use core\system\Router;
use core\eventlisteners\Event;


class StaffAuthorizationController extends AbstractController
{
    public function save($id) {
        echo 'in basic save';
        $result = $this->model->save($id);
        pr($result);
        die('save complete');
//        $router = new Router($this->logger, $this->httpRequest);
//        $router->redirect('admin_staff_permissions_get'); 
    }
    
    public function savePermissions($id) {
        $result = $this->model->savePermissions($id);
        
        //update the local user settings
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $result));
        
        $this->render($result);
    }
    
    public function saveCredentials($id) {
        $result = $this->model->saveCredentials($id);
        
        //update the local user settings
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $result));
//        
//        $router = new Router($this->logger, $this->httpRequest);
//        $router->redirect('admin_staff_permissions_get', array($id));
        //$this->render(array('success' => 'true'));
        $this->render($result);
    }
    
    public function ajaxSaveCredentials($id) {
        $result = $this->model->saveCredentials(intval($id));
        
        //update the local user settings
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $result));
        
        return $result;
    }
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function editCredentials($id) {
        $result = array('StaffAuthorization' => array());
        if(intval($id) > 0) {
            $result = $this->model->edit($id);
        }
        
        $result['form'] = $this->drawCredentialsForm($this->model,  $result['StaffAuthorization']);
      
        $this->render($result);
    } 
    
    public function getPermissions($id) {
        $result = $this->model->edit(intval($id));
        
        if(array_key_exists('StaffAuthorization', $result)) {
            $this->render(array('roles' => explode('|', $result['StaffAuthorization']['roles'])));
        } else {
           $this->render(array('success' => 'false', 'message' => 'unable to locate user')); 
        }
        
        
    }
    
    public function editPermissions($id) {
        $result = array('StaffAuthorization' => array());
        if(intval($id) > 0) {
            $result = $this->model->edit($id);
        }
        
        $form = $this->drawPermissionsForm($this->model, $result['StaffAuthorization']);
     
        $departments = $this->httpRequest->getAttribute('Departments');
        $roles = array();
        if(array_key_exists('roles', $result['StaffAuthorization'])) {
            $roles = explode('|', $result['StaffAuthorization']['roles']);
        }

        $this->render(array('Departments' => $departments, 'StaffAuthorization' => $result['StaffAuthorization'], 'roles' => $roles));
    }
    
    protected function drawCredentialsForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffAuthorizationBuilder = new StaffAuthorizationBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $options = array();
        return $staffAuthorizationBuilder->buildCredentialsForm($builder, $values, $options, $results);
    }
    
    protected function drawPermissionsForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffAuthorizationBuilder = new StaffAuthorizationBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $options = array();
        return $staffAuthorizationBuilder->buildCredentialsForm($builder, $values, $options, $results);
    }
    
    public function checkUsernameExists($id, $username) {
        $result = $this->model->get(array('username' => $username));
        
        if(is_array($result) && count($result) > 0) {
            $this->render(array('exists' => 'true'));
        } else {
            $this->render(array('exists' => 'false'));
        }
    }
}
