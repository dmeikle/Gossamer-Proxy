<?php
namespace core\components\locales\utils;

use core\components\locales\exceptions\LangFileNotFoundException;

class LocaleLoader
{
    private $localesList = array();
    
    public function loadFile($filepath) {
        
        if(file_exists($filepath)) {
            $loadedStrings = include $filepath;
            $this->localesList = array_merge($this->localesList, $loadedStrings);
        } else {
            throw new LangFileNotFoundException($filepath . ' does not exist');
        }
        
    }
    
    public function getString($key, $default = null) {
     
        if(array_key_exists($key, $this->localesList)) {
          
            return $this->localesList[$key];
        }
      
        return (is_null($default))? $key : $default;
    }
}