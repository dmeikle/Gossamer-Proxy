<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\workperformed\controllers;

use core\AbstractController;
use components\staff\serialization\DepartmentSerializer;
use components\claims\serialization\ClaimPhaseSerializer;
use components\workperformed\form\WorkPerformedBuilder;
use components\workperformed\serialization\WorkPerformedSerializer;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;
use core\navigation\Pagination;


class WorkPerformedController extends AbstractController
{
    
    
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {

       // pr($this->model->getEmptyModelStructure());
    

        $result = $this->model->edit($id);
        
        $departmentSerializer = new DepartmentSerializer();        
        $result['Departments'] = $departmentSerializer->formatDepartmentsArray($this->httpRequest->getAttribute('Departments'));
        unset($departmentSerializer);
        
        $claimPhaseSerializer = new ClaimPhaseSerializer();        
        $result['ClaimPhases'] = $claimPhaseSerializer->formatPhasesForSelection($this->httpRequest->getAttribute('ClaimPhases'));
        unset($claimPhaseSerializer);
        

        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $result)));

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
        $result['DepartmentsList'] = $departmentSerializer->formatDepartmentsArray($this->httpRequest->getAttribute('Departments'));
        unset($departmentSerializer);
        
        $claimPhaseSerializer = new ClaimPhaseSerializer();        
        $result['ClaimPhasesList'] = $claimPhaseSerializer->formatPhasesForSelection($this->httpRequest->getAttribute('ClaimPhases'));
        unset($claimPhaseSerializer);
        
        if(is_array($result) && array_key_exists($this->model->getEntity() .'sCount', $result)) {
            $pagination = new Pagination($this->logger);        
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
            unset($pagination);
        }
        
        $this->render($result);
    }
    
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {

        $formBuilder = new FormBuilder($this->logger, $model);
        $workBuilder = new WorkPerformedBuilder();
      
        $workBuilder->setLocales($this->httpRequest->getAttribute('locales'));
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        $departmentsList = $values['Departments'];
     
        $serializer = new WorkPerformedSerializer();
        $selectedOptions = array($workBuilder->getValue('Departments_id', $values));

        $options = array('Departments' => $serializer->formatSelectionBoxOptions($departmentsList, $selectedOptions));
        unset($serializer);
     
        $phasesList = $values['ClaimPhases'];
        $claimPhaseSerializer = new ClaimPhaseSerializer();  

        $selectedOptions = array($workBuilder->getValue('ClaimPhases_id', $values));         
        $options['ClaimPhases'] = $claimPhaseSerializer->formatSelectionBoxOptions($phasesList, $selectedOptions);
        
        $options['layers'] = $this->getLayers($values);
        $options['locales'] = $this->httpRequest->getAttribute('locales');
   
        return $workBuilder->buildForm($formBuilder, $values, $options, $results);
    }
    
    private function getLayers(array $values = null) {
        $layerId = 0;
        if(is_array($values) && array_key_exists('layer', $values)) {
            $layerId = $values['layer'];
        }
        
        $retval ='';
        
        for($i = 1; $i < 8; $i++) {
            $retval .= '<option value="' . $i . '"';
            if($i == $layerId) {
                $retval .= " selected";
            }
            $retval .= ">Layer $i</option>\r\n";
        }
        
        return $retval;

    }
}
