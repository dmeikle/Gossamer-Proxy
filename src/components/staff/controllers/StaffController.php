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
use components\departments\serialization\DepartmentSerializer;
use components\staff\form\StaffBuilder;
use components\staff\form\StaffEmergencyContactBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;
use core\navigation\Pagination;
use components\staff\serialization\StaffSerializer;
use components\staff\serialization\StaffPositionsSerializer;
echo __YML_KEY;
class StaffController extends AbstractController {

    public function save($id) {

        $result = $this->getEntity('Staff', $this->model->save(intval($id)));
        $entity = $this->getEntity('Staff', $result);

        //TODO: figure out where to redirect if result holds no 'id' key
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_staff_credentials_edit', array($result['id']));
    }
    
    public function searchByName() {
        $results = $this->model->search(array('firstname' => $this->getName()));
        
        $serializer = new StaffSerializer();
        $list = $serializer->formatNameResults($results);
        
        $this->render($list);
    }
    
    private function getName() {
        $rawName = $this->httpRequest->getQueryParameter('term');
        
        return preg_replace('/[^A-z]/', '', substr($rawName, 0, 10));
    }
    
    public function ajaxSave($id) {
        $result = $this->model->save(intval($id));
        
        $this->render(array('Staff' => $result));
    }
    
    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);
       
        $this->render($result['Staffs']);
//        $result = $this->model->listall($offset, $limit);
//
//        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
//            $pagination = new Pagination($this->logger);
//            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
//            unset($pagination);
//        }
//        
//        $result['form'] = $this->drawForm($this->model, array());
//        $result['eform'] = $this->drawEmergencyContactForm($this->model, array());
//        $result['id'] = 0;
//        $this->render($result);
    }
    
    public function index() {
        $result = array();
        $result['form'] = $this->drawForm($this->model, array());
        $result['eform'] = $this->drawEmergencyContactForm($this->model, array());
        $result['id'] = 0;
        $this->render($result);
    }
    
    public function createNew() {
        $this->edit(0);
    }
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = (intval($id) > 0) ? $this->model->edit(intval($id)) : array();
        
        if (is_array($result)) {
            $result['form'] = $this->drawForm($this->model, $result);
            $result['eform'] = $this->drawEmergencyContactForm($this->model, array());
        } else {
            $result['form'] = $this->drawForm($this->model, array());
        }
        $result['id'] = intval($id);
        
        $this->render($result);
    }

    public function ajaxEdit($id) {
        $result = $this->model->edit(intval($id));
        unset($result['emergencyContacts']);
    
        $this->render(array('Staff' => $result));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
     
       
        $provinceList = $this->httpRequest->getAttribute('Provinces');
        $serializer = new ProvinceSerializer();
        $selectedOptions = array($staffBuilder->getValue('Provinces_id', $values));
        $options = array('provinces' => $serializer->formatSelectionBoxOptions($serializer->pruneList($provinceList), $selectedOptions));
        
        $positions = $this->httpRequest->getAttribute('StaffPositions');
        $serializer = new StaffPositionsSerializer();        
        $selectedOptions = array($staffBuilder->getValue('StaffPositions_id', $values));
        $options['staffPositions'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($positions), $selectedOptions);
        
        $departments = $this->httpRequest->getAttribute('Departments');
        $serializer = new DepartmentSerializer();        
        $selectedOptions = array($staffBuilder->getValue('Departments_id', $values));
        $options['departments'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($departments), $selectedOptions);
        
        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }

    protected function drawEmergencyContactForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffEmergencyContactBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $options = array();

        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }
    
    public function backboneEdit($id) {
        $result = $this->model->edit(intval($id));

        $this->render($result);
    }
    
    public function backboneSave() {
        $params = $this->httpRequest->getRestParameters();
        print_r($params);
        $this->render(array());
    }
    

    
}
