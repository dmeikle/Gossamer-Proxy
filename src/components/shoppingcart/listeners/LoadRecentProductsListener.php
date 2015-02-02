<?php

namespace components\shoppingcart\listeners;

use core\eventlisteners\AbstractListener;
use components\shoppingcart\models\ProductModel;

class LoadRecentProductsListener extends AbstractListener
{
    public function on_request_start($params) {
       
       $retval = array();
       $model = new ProductModel($this->httpRequest, $this->httpResponse, $this->logger);
       $defaultLocale =  $this->getDefaultLocale();
       $params = array(
           'locale' => $defaultLocale['locale']
               
            );

       $datasource = $this->getDatasource('components\shoppingcart\models\ProductModel');
       
       $products = $datasource->query('get', $model, 'list', $params);

       $this->httpRequest->setAttribute('Products', $products['Products']);
        unset($model);
    }
}