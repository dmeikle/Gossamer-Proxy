<?php
namespace core\components\locales\utils;

class LocaleLoader
{
    private $localesList = array();
    
    public function loadFile($filepath) {
        $this->localesList = array_merge($this->localesList, include $filepath);
    }
    
    public function getString($key, $default = null) {
        if(array_key_exists($key, $this->localesList)) {
            return $this->localesList[$key];
        }
        
        return (is_null($default))? $key : $default;
    }
}