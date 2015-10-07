<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class GeneralCostsController extends AbstractController{
   
    public function search() {
        $params = $this->httpRequest->getQueryParameters();
        $offset = 0;
        $limit = 20;
        
        $result = $this->model->listallWithParams($offset, $limit, $params, 'search');
        
        $this->render($result);
    }
}
