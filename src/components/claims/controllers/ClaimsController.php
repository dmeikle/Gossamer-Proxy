<?php
namespace components\claims\controllers;

use core\AbstractController;
use components\companies\serialization\CompanyTypeSerialization;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\claims\form\ClaimBuilder;
use core\system\Router;



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
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
    
    public function save($id) {
        $result = $this->model->save($id);
        
        $this->render($result);
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $claimBuilder = new ClaimBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();
        
        return $claimBuilder->buildForm($builder, $values, $options, $results);
    }
    
    public function listallByProjectAddress($addressId, $offset, $limit) {
        $result = $this->model->listallByProjectAddress($addressId, $offset, $limit);
        
        $this->render($result);
    }
}
