<?php

namespace libraries\utils;

use exceptions\ObjectNotFoundException;

class Container
{
    private $directory = null;
    
    public function __construct() {
      
    }
    
    public function get($key, $defaultType = null) {
        $directory = $this->getDirectory();

        if(!array_key_exists($key, $directory)) {
            if(is_null($defaultType)) {
                throw new ObjectNotFoundException($key . ' does not exist in container');
            }
            
            return $defaultType;
        }
        
        $item = $directory[$key];
        
        if(is_null($item['object'])) {
            $item['object'] = new $item['objectPath']();
        }
        
        $directory[$key] = $item;
        $this->directory = $directory;
        
        return $item['object'];
    }
    
    private function getDirectory() {
        if(is_null($this->directory)) {
            $this->directory = array();
        }
        
        return $this->directory;
    }
    
    public function set($key, $objectPath, $object = null) {
        $directory = $this->getDirectory();
        $directory[$key] = array('objectPath' => $objectPath, 'object' => $object);
        $this->directory = $directory;
    }
}
