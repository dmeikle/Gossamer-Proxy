<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\companies\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\companies\form\CompanyBuilder;
use components\geography\serialization\ProvinceSerializer;
use core\serialization\Serializer;

class CompaniesController extends AbstractController
{
    public function search() {
        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }

    public function searchResults() {
        $result = $this->model->searchResults();
        $searchResults = $this->httpRequest->getAttributes('searchResults');
        
        return $this->render($result);
    }

    public function edit($id) {
        $result = $this->model->edit(intval($id));
        
        return $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    public function get($id) {
        $result = $this->model->edit(intval($id));
        
        return $this->render($result);

    }
    
    public function listallClaims($companyId) {
        $offset = 0;
        $limit = 20;
        $params = array(
            'Companies_id' => intval($companyId),
            'directive::DIRECTION' => 'desc',
            'directive::ORDER_BY' => 'dateReceived');
        
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'listbycompany');
        
        $this->render($result);
    }
    
    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     
    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);
        $paginationResult = '';
       
        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $paginationResult = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
            
            $this->render(array('Companys' => current($result), 'pagination' => $paginationResult, 'form' => $this->drawForm($this->model, array())));
        } else {
            $this->render(array('Companys' => $result, 'form' => $this->drawForm($this->model, array())));
        }
    }
    */
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $companyBuilder = new CompanyBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $options = array();
       
        $provinceList = $this->httpRequest->getAttribute('Provinces');
        $serializer = new ProvinceSerializer();
        $selectedOptions = array($companyBuilder->getValue('Provinces_id', $values));
        $options['provinces'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($provinceList), $selectedOptions);
        
        $typesList = $this->httpRequest->getAttribute('CompanyTypes');
        $serializer = new Serializer();
        $selectedOptions = array($companyBuilder->getValue('CompanyTypes_id', $values));
        $options['companyTypes'] = $serializer->formatSelectionBoxOptions($typesList, $selectedOptions, 'type');
        
        $countries = $this->httpRequest->getAttribute('Countrys');
        $selectedOptions = array($companyBuilder->getValue('Countries_id', $values));
        $options['countries'] = $serializer->formatSelectionBoxOptions($countries, $selectedOptions, 'country');
        
        
           
        return $companyBuilder->buildForm($builder, $values, $options, $results);
    }
//    
//    public function backboneListall($offset, $limit) {
//        $result = $this->model->listall($offset, $limit);
//        
//        $list = array_key_exists('Companys', $result) ? $result['Companys'] : array();
//        $this->render($list);
//    }
    
    public function pagination($offset, $limit) {
        $result = $this->model->getPagination($offset, $limit);
        
        $list = array_key_exists('Companys', $result) ? $result['Companys'] : array();
        $this->render($list);
    }
    
    public function listallByCompanyId($companyId) {
        $result = $this->model->listallByCompanyId(intval($companyId));
        
        $this->render($result);
    }
}
