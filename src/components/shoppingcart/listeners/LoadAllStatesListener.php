<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\listeners;

use core\eventlisteners\AbstractListener;
use libraries\utils\Registry;
use components\shoppingcart\models\StateModel;

class LoadAllStatesListener extends AbstractListener
{
 
   public function on_request_start($params = array()) {
       
       $retval = array();
       $model = new StateModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $defaultLocale =  $this->getDefaultLocale();
       $params = array('locale '=> $defaultLocale['locale']);

       $datasource = $this->getDatasource('components\shoppingcart\models\StateModel');
       
       $states = current($datasource->query('get', $model, 'list', $params));

        foreach($states as $row) {
            foreach($row as $state){
                $retval[$state['id']] = $state['state'];
            }
        }

        $this->httpRequest->setAttribute('stateList', $retval);
        unset($model);
   }


}
