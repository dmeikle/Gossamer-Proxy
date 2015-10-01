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
use core\navigation\Pagination;



/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search($this->httpRequest->getQueryParameters());
        
        $this->render($result);
    }
    
    public function searchByJobNumber() {
        $results = $this->model->searchByJobNumber(array('jobNumber' => $this->getJobNumber()));
        
        $serializer = new ClaimSerializer();
        $list = $serializer->formatJobNumberResults($results);

        $this->render($list);
    }

    public function editByJobNumber($jobNumber) {
        $result = $this->model->get(array('jobNumber' => preg_replace('/[^A-z0-9\-]/', '', $jobNumber)));            
        $companyTypes = $this->httpRequest->getAttribute('CompanyTypes');
        
        if(!is_null($companyTypes)) {
            $serializer = new CompanyTypeSerialization(); 
            $companyTypes = $serializer->pruneCompanyTypes($companyTypes);
           
            $companyTypesOptions = $serializer->formatSelectionBoxOptions($companyTypes, array());
            $result['companyTypesOptions'] = $companyTypesOptions;
        }
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
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
    
    public function get($claimId) {
        //$result = $this->model->get($claimId);              
        $claim = $this->httpRequest->getAttribute('Claim');
        
        $this->render(array('claim' => $claim));
    }
    
 
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $claimBuilder = new ClaimBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();
       // pr($this->httpRequest->getAttribute('ClaimTypes'));
        return $claimBuilder->buildForm($builder, $values, $options, $results);
    }
    
    public function listallByProjectAddress($addressId, $offset, $limit) {
        $result = $this->model->listallByProjectAddress($addressId, $offset, $limit);
        
        $this->render($result);
    }
    
   
               
    private function getJobNumber() {
        $rawJobNumber = $this->httpRequest->getQueryParameter('Claims_id'); //changed from 'term'
        
        return preg_replace('/[^A-z0-9\-]/', '', substr($rawJobNumber, 0, 10));
    }
    
    public function view($claimNumber = null) {
        $result = $this->model->view($claimNumber);
        
        $this->render($result);
    }
    
    
    /**
     * listallReverseWithForm - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listallReverseWithForm($offset = 0, $limit = 20) {
        $result = $this->model->listallReverse($offset, $limit);

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $paginationResult = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
            
            $this->render(array($this->model->getEntity() . 's' => current($result), 'pagination' => $paginationResult, 'form' => $this->drawForm($this->model, array())));
        } else {
            $this->render(array($this->model->getEntity() . 's' => $result, 'form' => $this->drawForm($this->model, array())));
        }

       // $this->render($result);
    }
    
    public function getNewCount($numDays) {
        $params = array('key' => 'claims_total_active_new', 'range' => intval($numDays));
        
        $result = $this->model->getCount($params);
        
        $this->render($result);
    }
    
    public function getOpenCount() {
        
        $params = array('projectManager_id' => $this->getLoggedInUser()->getId(), 'isActive' => '1', 'key' => 'claims_total_active_by_status', 'statusType' => '5,8');
        
        $result = $this->model->getCount($params);
        
        $this->render($result);
        
    }
}
