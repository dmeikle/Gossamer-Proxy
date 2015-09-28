<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\controllers;

use core\AbstractController;
use core\navigation\Pagination;
use components\events\form\ProspectBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;

class EventProspectsController extends AbstractController
{
    
    /**
     * listall - retrieves rows based on offset, limit
     * 
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset=0, $limit=20) {
        $result = $this->model->listall($offset, $limit);
      
        $result['Events'] = $this->httpRequest->getAttribute('Events');
      
        if(array_key_exists($this->model->getEntity() .'sCount', $result)) {
            $pagination = new Pagination($this->logger);        
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
            unset($pagination);
        }
        
        $this->render($result);
    }
    
    
    public function listAllByEventId($id, $offset, $limit) {
       
        $result = $this->model->listAllByEventId($id, $offset, $limit);
        $result['Event'] = $this->httpRequest->getAttribute('Event');
        $pagination = new Pagination($this->logger);        
        $result['pagination'] = $pagination->paginate($result['EventProspectsCount'], $offset, $limit, '/admin/events/eventprospects');       
        unset($pagination);
       
        $this->render($result);
    }
    
    public function edit($id) {
        $values = $this->model->edit($id);
        
        $this->render(array('form' => $this->drawForm($this->model, $values)));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new ProspectBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));
        
        $options = array();

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
    
    public function save($id) {
        $this->saveAndRedirect($id, 'admin_event_prospects_list', array(0,20));
    }
    
}
