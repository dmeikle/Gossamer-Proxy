<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\twitter\controllers;

use core\AbstractController;
use components\twitter\serialization\TwitterSerializer;

/**
 * TicketStatusesController
 *
 * @author Dave Meikle
 */
class TwitterController extends AbstractController {
    
   public function getTraffic($numRows) {
       $result = $this->model->getTraffic($numRows);
       
       $serializer = new TwitterSerializer();
       
       $this->render(array('feed' => $serializer->formatResults($result)));
   }
}
