<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;
use components\companies\serialization\CompanyTypeSerialization;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\claims\form\ClaimBuilder;
use components\claims\serialization\ClaimSerializer;



/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function searchByJobNumber() {
        $results = $this->model->searchByJobNumber(array('jobNumber' => $this->getJobNumber()));
        
        $serializer = new ClaimSerializer();
        $list = $serializer->formatJobNumberResults($results);

        $this->render($list);
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
    
   
               
    private function getJobNumber() {
        $rawJobNumber = $this->httpRequest->getQueryParameter('term');
        
        return preg_replace('/[^A-z0-9\-]/', '', substr($rawJobNumber, 0, 10));
    }
}
