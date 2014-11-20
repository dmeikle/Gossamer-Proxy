<?php

namespace components\staff\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\geography\serialization\ProvinceSerializer;
use components\staff\form\StaffBuilder;


class StaffController extends AbstractController
{
    public function save($id) {
        $this->render(array());
    }
    public function savePermissions($id) {
        $result = $this->model->savePermissions($id);
        
        $this->render($result);
    }
    
    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        
        $result = $this->model->edit($id);
       
        if(is_array($result) && array_key_exists('Staff', $result)) {
            $staff = current($result['Staff']);            

            $result['form'] = $this->drawForm($this->model, $staff);
        } else {
             $result['form'] = $this->drawForm($this->model, array());
        }
        
        $this->render($result);
    }
    
    
    private function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        
       
        $provinceList = $this->httpRequest->getAttribute('Provinces');
       
        $serializer = new ProvinceSerializer();
        $selectedOptions = array($staffBuilder->getValue('Provinces_id', $values));
        
        $options = array('provinces' => $serializer->formatSelectionBoxOptions($serializer->pruneList($provinceList), $selectedOptions));
        
        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }
}
