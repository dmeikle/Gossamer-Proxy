<?php

namespace core\components\locales\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\locales\models\LocaleModel;

class LoadLocalesListener extends AbstractCachableListener
{
    public function on_request_start($filename) {
        $retval = array();
        $model = new LocaleModel($this->httpRequest, $this->httpResponse, $this->logger);
 
        $params = array();
        $caching = true;
        $datasource = $this->getDatasource(get_class($model));
        try {
            $result = $datasource->query('get', $model, 'list', $params);
            
            if(is_array($result) && count($result) > 0) {
               $locales = current($result); 
            
                foreach($locales as $locale) {
                    $retval[$locale['locale']] = $locale;
                }

                $this->httpRequest->setAttribute('locales', $retval);
            }
            
        }catch(\Exception $e){}
        unset($model);
        
        //now to cache the values
         //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic

        $key = $this->getKey();     
        
        if(is_array($retval) && count($retval) > 0) {
            
            if(is_null($key)) {
              
                $key = key($retval);
                $caching = false; //it wasn't set so don't try to cache the value
            }            
            
            if($caching && count($retval) > 0) {
                $this->saveValuesToCache($key, $retval);
            }
        }  
         
    }
    
}