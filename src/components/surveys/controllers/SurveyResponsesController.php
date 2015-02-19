<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\controllers;

use core\AbstractController;
use core\system\Router;


/**
 * Description of ScopingFormsController
 *
 * @author Dave Meikle
 */
class SurveyResponsesController extends AbstractController{
    
    
    public function view($id, $page) {        
        $results = $this->model->getCompletedSurvey($id, $page);
        $page = current($results['page']);
        $panes = $results['panes'];
        
        $this->render(array('page' => $page, 'panes' => $panes));
    }
    
}
