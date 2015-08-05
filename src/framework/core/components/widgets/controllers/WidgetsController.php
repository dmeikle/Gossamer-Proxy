<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\controllers;

use core\AbstractController;
use core\navigation\Pagination;

/**
 * WidgetsController
 *
 * @author Dave Meikle
 */
class WidgetsController extends AbstractController {
    
 
    public function listallUnassigned($idList, $offset = 0, $rows = 20) {
        $filteredList = preg_replace('/[^0-9,]/', '', $idList); // Removes special chars.
      
        $filter = array('widgetIds' => $filteredList);
        
        $result = $this->model->listallWithParams($offset, $rows, $filter, 'listunused');
  
        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
           
            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $rows, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }
        
        $this->render($result);
    }
    
    
}
