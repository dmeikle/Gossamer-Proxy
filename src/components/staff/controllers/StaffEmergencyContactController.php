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
use components\geography\serialization\ProvinceSerializer;
use components\staff\form\StaffEmergencyContactBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;

class StaffEmergencyContactController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = array();
        if(intval($id) > 0) {
            $result = $this->model->edit($id);
        }
        if (is_array($result)) {
            $result['form'] = $this->drawForm($this->model, $result);
        } else {
            $result['form'] = $this->drawForm($this->model, array());
        }

        $this->render($result);
    }

    public function listallByStaffId($id) {
        $result = $this->model->listallWithParams(0,20, array('Staff_id' => intval($id)));
        if(array_key_exists('EmergencyContacts', $result)) {
            $result = $result['EmergencyContacts'];
        }
        $this->render(array('EmergencyContacts' => $result, 'form' => $this->drawForm($this->model)));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffEmergencyContactBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $options = array();

        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }

    public function save($id) {
        
        //we need to stuff the Staff_id into the params, but don't want it in 
        //the page where a hacker can change its values
        $params = $this->httpRequest->getPost();
        $params['StaffEmergencyContact']['Staff_id'] = intval($id);
        
      
        $this->httpRequest->setPostParameter('StaffEmergencyContact', $params['StaffEmergencyContact']);
        //we want to add a new row so set id to 0
        $this->saveAndRedirect(0, 'admin_staff_emergencycontacts_list', array($id));
    }
    
    public function getForm() {
        $this->render($this->drawForm($this->model, $value));
    }
}
