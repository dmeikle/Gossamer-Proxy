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

/**
 * WidgetsController
 *
 * @author Dave Meikle
 */
class WidgetsController extends AbstractController {
    
 
    public function listallUnassigned($idList, $offset = 0, $rows = 20) {
        $result = $this->httpRequest->getAttribute('unassignedWidgets');
        
        $this->render($result);
    }
    
    
}
