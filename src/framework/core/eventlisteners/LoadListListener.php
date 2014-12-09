<?php

namespace core\eventlisteners;

/**
 * Description of LoadListListener
 *
 * @author davem
 */
class LoadListListener extends AbstractCachableListener{
    
    
    //while this loads the list into httprequest, you still need to add it from the request
    //into the data array if needed in the view.
    //this gets called only if it fails the cached values check, so you won't see
    //any 'get from cache' in this method
    protected function loadList() {
        
        $caching = true;
        
        $class = $this->listenerConfig['class'];
        $params = (array_key_exists('params', $this->listenerConfig)? $this->listenerConfig['params'] : array());
      
        $defaultLocale = $this->getDefaultLocale();
        if(!array_key_exists('locale', $params)) {
            $params['locale'] = $defaultLocale['locale'];
        }
        
        $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($class);
       
        $result = $datasource->query('get', $model, 'list', $params);
        $list = array();
        
        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = $this->getKey();
        
        if(!is_null($result) && is_array($result)) {
            
            if(is_null($key)) {
              
                $key = key($result);
                $caching = false; //it wasn't set so don't try to cache the value
            }            
            
            $list = $result[$key];           
            
        }        
    
        $this->httpRequest->setAttribute($key, $list);
        
        if($caching && count($list) > 0) {
            $this->saveValuesToCache($key, $list);
        }
       
    }
    
    public function on_request_start($params) {
        $this->loadList();
    }
    
    public function on_request_end($params) {
        $this->loadList();
    }
    
    public function on_response_start($params) {
        $this->loadList();
    }
    
    public function on_response_end($params) {
        $this->loadList();
    }
}
