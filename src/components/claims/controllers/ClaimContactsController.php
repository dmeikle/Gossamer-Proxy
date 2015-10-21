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


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimContactsController extends AbstractController
{
   public function listContacts($claimId) {
       $offset = 0;
       $limit = 10;
       
       $params = array('Claims_id' => intval($claimId));
       
       $result = $this->model->listAllWithParams($offset, $limit, $params, 'listByClaim');
       
       $this->render($result);
   }
}
