<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contactus\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\contactus\form\ContactUsBuilder;
use components\contactus\serialization\ContactUsTypeSerialization;
use core\navigation\Pagination;

class ContactUsController extends AbstractController
{
    public function view() {
        $this->render(array('form' => $this->drawForm($this->model)));
    }
    
    public function save($id) {
        parent::saveAndRedirect(0, 'website_contactus_complete', array());
    }
    
    public function adminView($id) {
        $result = $this->model->edit($id);
        
        $this->render(array('form' => $result));
    }
    public function listallReverse($offset = 0, $limit = 20) {
        $result = $this->model->listallReverse($offset, $limit);
     
        if(is_array($result) && array_key_exists($this->model->getEntity() .'sCount', $result)) {
            $pagination = new Pagination($this->logger);        
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
            unset($pagination);
        }
        //get the contactUsType list formated into results
        $this->formatContactUsType($result);
        
        $this->render($result);
    }

    private function formatContactUsType(array &$result) {
        $contactUsTypes = $this->httpRequest->getAttribute('ContactUsTypes');
        $types = array();
        
        //first let's format the contactUsTypes list into readable format
        foreach($contactUsTypes as $type) {
            if(count($type) ==0) {
                continue;
            }
            $types[$type['id']] = $type['type'];
        }
        $retval = array();
        foreach($result['ContactUss'] as $row) {
            if(count($row) == 0) {
                continue;
            }
            if(!array_key_exists($row['ContactUsTypes_id'], $types)) {
                $row['contactUsType'] = 'unspecified';                
            } else {
                $row['contactUsType'] = $types[$row['ContactUsTypes_id']];
            }            
            
            $retval[] = $row;
        }
       
        $result['ContactUss'] = $retval;
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $contactusBuilder = new ContactUsBuilder();
        
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $contactusTypes = $this->httpRequest->getAttribute('ContactUsTypes');
        
        $contactUsSerializer = new ContactUsTypeSerialization();
        
        
        $options = array(
            'ContactUsTypes' => $contactUsSerializer->formatSelectionBoxOptions($this->httpRequest->getAttribute('ContactUsTypes'), array($values['ContactUsTypes_id']),'type')
        );
        
        
        unset($serializer);
        
        return $contactusBuilder->buildForm($builder, $values, $options, $results);
    }
    
    
}
