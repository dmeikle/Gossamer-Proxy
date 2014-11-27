<?php

namespace components\workperformed\controllers;

use core\AbstractController;
use components\staff\serialization\DepartmentSerializer;
use components\claims\serialization\ClaimPhaseSerializer;
use components\workperformed\form\WorkPerformedBuilder;
use components\workperformed\serialization\WorkPerformedSerializer;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;


class WorkPerformedController extends AbstractController
{
    
    
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);
        
        $departmentSerializer = new DepartmentSerializer();        
        $result['Departments'] = $departmentSerializer->formatDepartmentsArray($this->httpRequest->getAttribute('Departments'));
        unset($departmentSerializer);
        
        $claimPhaseSerializer = new ClaimPhaseSerializer();        
        $result['ClaimPhases'] = $claimPhaseSerializer->formatPhasesForSelection($this->httpRequest->getAttribute('ClaimPhases'));
        unset($claimPhaseSerializer);
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
    
    public function save($id) {
        $result = $this->model->save($id);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_workperformed_list', array('0', '20'));
    }
    
     /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset=0, $limit=20) {
        $result = $this->model->listall($offset, $limit);
        
        $departmentSerializer = new DepartmentSerializer();        
        $result['Departments'] = $departmentSerializer->formatDepartmentsArray($this->httpRequest->getAttribute('Departments'));
        unset($departmentSerializer);
        
        $claimPhaseSerializer = new ClaimPhaseSerializer();        
        $result['ClaimPhases'] = $claimPhaseSerializer->formatPhasesForSelection($this->httpRequest->getAttribute('ClaimPhases'));
        unset($claimPhaseSerializer);
        
        $this->render($result);
    }
    
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $workBuilder = new WorkPerformedBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        
        $departmentsList = $values['Departments'];
        $serializer = new WorkPerformedSerializer();
        $selectedOptions = array($workBuilder->getValue('Departments_id', $departmentsList));
        $options = array('Departments' => $serializer->formatSelectionBoxOptions($departmentsList, $selectedOptions));
        unset($serializer);
     
        $phasesList = $values['ClaimPhases'];
        $claimPhaseSerializer = new ClaimPhaseSerializer();  
        $selectedOptions = array($workBuilder->getValue('ClaimPhases_id', $phasesList));         
        $options['ClaimPhases'] = $claimPhaseSerializer->formatSelectionBoxOptions($phasesList, $selectedOptions);
        
        $options['layer'] = '<option value="1">1</option>';
        $options['locales'] = $this->httpRequest->getAttribute('locales');
        
        return $workBuilder->buildForm($builder, $values, $options, $results);
    }
}
