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
use components\shoppingcart\models\CategoryModel;

class LoadCategoryIdListener extends AbstractListener
{
 
   public function on_request_start($params = array()) {
      
       $params = $this->httpRequest->getParameters();
    
       $retval = array();
       $model = new CategoryModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $defaultLocale =  $this->getDefaultLocale();
       
       $category = array('category' => current($params));

       $datasource = $this->getDatasource('components\shoppingcart\models\CategoryModel');
       
       $result = $datasource->query('get', $model, 'get', $category);
       $category = current($result['Category']);

        $this->httpRequest->setAttribute('category', $category);
        unset($model);
   }


}
