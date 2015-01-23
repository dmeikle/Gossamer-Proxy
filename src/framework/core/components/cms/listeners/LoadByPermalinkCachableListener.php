<?php

namespace core\components\cms\listeners;

use core\eventlisteners\AbstractCachableListener;

/**
 * LoadByPermalink - this will allow the cms to cache portions of the page
 * rather than
 *
 * @author davem
 */
class LoadByPermalinkCachableListener extends AbstractCachableListener{
    
    public function on_request_start($params) {

        $caching = true;
        
        $requestParams = $this->httpRequest->getParameters();
       
        $params['permalink'] = end($requestParams);
       
        $key = $this->getKey();
        if(is_null($key)) {
            $caching = false; //it wasn't set so don't try to cache the value
        } else {
            //use all requestParams to avoid name collisions on pages with
            //same name in other sections
            $key .= '-' . implode('_', $requestParams); 
        }
        
        $item = $this->getValuesFromCache($key);
        $class = $this->listenerConfig['class'];
        
        if($item === false) {
            $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
            $datasource = $this->getDatasource($class);

            $result = $datasource->query('get', $model, 'get', $params);

            if(!is_null($result) && is_array($result)) {
                $item = current($result[$model->getEntity()]);
            } 

            if($caching && !is_null($item) > 0) {
                $this->saveValuesToCache($key, $item);
            }
        }    

        //set it here in case we want to use it still before sending to response
        $this->httpRequest->setAttribute($class, $item);

        //send it here in case it's being called in an abstract parent and won't
        //be seen until the response is rendered
        $this->httpResponse->setAttribute($class, $item);
    }
}
