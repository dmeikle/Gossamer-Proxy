<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\eventlisteners;

/**
 * Description of LoadItemListener
 *
 * @author davem
 */
class LoadItemListener extends AbstractCachableListener{
    
    protected function loadItem() {
        
        $caching = true;
      
        $class = $this->listenerConfig['class'];
        //$params = (array_key_exists('params', $this->listenerConfig)? $this->listenerConfig['params'] : array());
        $params = $this->getParameters();
      
        $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($class);
       
        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = $this->getKey();
        if(is_null($key)) {
            $caching = false; //it wasn't set so don't try to cache the value
        }   
       
        $result = $datasource->query('get', $model, 'get', $params);
      
        if(!is_null($result) && is_array($result)) {
            $item = current($result[$model->getEntity()]);
        }        
      
        $this->httpRequest->setAttribute($class, $item);
        
        if($caching && !is_null($item) > 0) {
            $this->saveValuesToCache($key, $item);
        }
    }
    
    protected function getParameters() {
        $configParams = (array_key_exists('params', $this->listenerConfig)? $this->listenerConfig['params'] : array());
        
        if(array_key_exists('type', $configParams)) {
            if($configParams['type'] == 'uri') {
                return $this->httpRequest->getParameters();
            }
        }
        
        return $configParams;
    }
    
    public function on_request_start($params) {
        $this->loadItem();
    }
    
    public function on_request_end($params) {
        $this->loadItem();
    }
    
    public function on_response_start($params) {
        $this->loadItem();
    }
    
    public function on_response_end($params) {
        $this->loadItem();
    }
    
    public function on_entry_point($params) {
        $this->loadItem();
    }
}
