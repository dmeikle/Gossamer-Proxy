<?php


namespace core\eventlisteners;

use exceptions\KeyNotSetException;

/**
 * Description of AbstractCachableListener
 *
 * @author davem
 */
class AbstractCachableListener extends AbstractListener{
    
    const MAX_FILE_LIFESPAN = 20000; //20 minutes
    
    //this value MUST be assigned by child class
    protected $key = null;
    
    public function execute($state, &$params) {
       
        $method = 'on_' . $state;
        error_log('inside cachable - method is ' . $method);
        $this->logger->addDebug('checking cachablelistener for method: ' . $method);
         if (method_exists($this, $method)) {
             //first check cache
            $key = $this->getKey();
           error_log('inside cachable - key is ' . $key);
            $values = '';
            
            if(!is_null($key)) {
                $values = $this->getValuesFromCache($key);                
            }            
            
            if(is_null($key) || $values === false) {
               
                $this->logger->addDebug('class: ' . get_class($this) . ' found');
                call_user_func_array(array($this, $method), array($params));       
                
                return;
            }            
            
            $this->httpRequest->setAttribute(self::getKey(), $values);
        }
        
    }
    
    /**
     * can be overridden for custom keys
     * @return string
     */
    protected function getKey() {
        if(array_key_exists('cacheKey', $this->listenerConfig)) {
            return $this->listenerConfig['cacheKey'];
        }
        
        return null;
    }
    
    protected function saveValuesToCache($key, $values) {
       
        try{
            $file = fopen(__CACHE_DIRECTORY . "$key.cache", "w") or die("Unable to open file!");
        }  catch (\Exception $e) {
            $this->logger->addError($e->getMessage());
            
            return false;
        }
        
        fwrite($file, $this->formatValuesBeforeSaving($values));
        fclose($file);
        
        return true;
    }
    
    private function formatValuesBeforeSaving($values) {
        if(is_array($values)) {
            return "<?php\r\n"
            . "return " . $this->parseArray($values) . ";";
        }
        
        return $values;
    }
    
    private function parseArray(array $values) {
        $retval = "array (";
        $elements = '';
        foreach($values as $key => $row) {
            if(is_array($row)) {
                $elements .= ",\r\n'$key' => " . $this->parseArray($row) ;
            }else{
               $elements .= ",\r\n'$key' => '$row'"; 
            }            
        }
        $retval .= substr($elements, 1) . ")";
        
        return $retval;
    }
    
    protected function getValuesFromCache($key) {
        if(file_exists(__CACHE_DIRECTORY . "$key.cache") && $this->isNotStale(__CACHE_DIRECTORY . "$key.cache")) {
            
            $loadedValues = include __CACHE_DIRECTORY . "$key.cache";
            return $loadedValues;            
        }
        
        return false;
    }
    
    private function isNotStale($filepath) {
        $filetime = filemtime($filepath);
        $currentTime = time();
        
        return ($currentTime - $filetime) < self::MAX_FILE_LIFESPAN;
    }
}
