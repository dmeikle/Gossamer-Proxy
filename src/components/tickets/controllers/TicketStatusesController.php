<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\tickets\controllers;

use core\AbstractController;
use components\tickets\forms\TicketStatusBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * TicketStatusesController
 *
 * @author Dave Meikle
 */
class TicketStatusesController extends AbstractController {
    
    public function edit($id) {
        $values = $this->model->edit($id);
        $this->render(array('TicketStatus' => $values));
        
        //$this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $values)));
    }
    
    
//    public function save($id) {
//        parent::saveAndRedirect($id, 'admin_event_types_list', array(0,20));
//    }
    
    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);
      
        //need the drawform called for adding rows through ajax
        $this->render(array('TicketStatuss' => $result['TicketStatuss'], 'TicketStatussCount' => $result['TicketStatussCount'], 'form' => $this->drawForm($this->model)));
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new TicketStatusBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );
        
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
}
