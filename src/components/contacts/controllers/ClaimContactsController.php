<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimContactsController extends AbstractController
{
   
    public function listallByClaim($jobNumber) {
        
        $result = $this->model->listallByClaim($jobNumber);
        
        $this->render($result);
    }
}
