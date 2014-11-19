<?php
namespace components\claims\controllers;

use core\AbstractController;
use components\companies\serialization\CompanyTypeSerialization;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class ClaimsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function get($id) {
        $result = $this->model->get($id);
        
        $this->render($result);
    }
    
    public function edit($id) {
        $result = $this->model->edit($id);              
        $companyTypes = $this->httpRequest->getAttribute('CompanyTypes');
        
        if(!is_null($companyTypes)) {
            $serializer = new CompanyTypeSerialization(); 
            $companyTypes = $serializer->pruneCompanyTypes($companyTypes);
           
            $companyTypesOptions = $serializer->formatSelectionBoxOptions($companyTypes, array());
            $result['companyTypesOptions'] = $companyTypesOptions;
        }
        $this->render($result);
    }
    
    public function save($id) {
        $result = $this->model->save($id);
        
        $this->render($result);
    }
}
