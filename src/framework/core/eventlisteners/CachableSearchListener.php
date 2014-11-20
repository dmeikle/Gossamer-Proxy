<?php

namespace core\eventlisteners;

/**
 * Description of LoadListListener
 *
 * @author davem
 */
class CachableSearchListener extends AbstractCachableListener{
    
    //overridable for custom searches on db-repo
    protected $verb = 'list';
    
    //while this loads the list into httprequest, you still need to add it from the request
    //into the data array if needed in the view
    protected function search($params) {
        error_log("entering");
        $caching = true;
        
        $class = $this->listenerConfig['class'];
        $params = (array_key_exists('params', $this->listenerConfig)? $this->listenerConfig['params'] : array());
      
        $defaultLocale = $this->getDefaultLocale();
        if(!array_key_exists('locale', $params)) {
            $params['locale'] = $defaultLocale['locale'];
        }
        $params['term'] = $this->getSearchTerm();
        
        $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($class);
       
        $result = $datasource->query('get', $model, $this->verb, $params);
        $list = array();
       
        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = parent::getKey();
        
        if(!is_null($result) && is_array($result)) {
            
            if(is_null($key)) {
              
                $key = key($result);
                $caching = false; //it wasn't set so don't try to cache the value
            }            
            
            $list = $result[$key];           
            
        }        
    
        $this->httpRequest->setAttribute($key, $list);
       
        if($caching && count($list) > 0) {
            $this->saveValuesToCache($this->getKey(), $list);
        }
       
    }
    
    public function on_request_start($params) {
        $this->search($params);
    }
    
    public function on_request_end($params) {
        $this->search($params);
    }
    
    public function on_response_start($params) {
        $this->search($params);
    }
    
    public function on_response_end($params) {
        $this->search($params);
    }
    
    protected function getSearchTerm() {
        $passedParams = $this->httpRequest->getPost();
       
        if(array_key_exists('term', $passedParams)) {
            return $passedParams['term'];
        }
    }
    
    
    protected function getKey() {
       
        $key = parent::getKey();
        $term = $this->getSearchTerm();
        
        return $key . '_' . $term;
    }
}
