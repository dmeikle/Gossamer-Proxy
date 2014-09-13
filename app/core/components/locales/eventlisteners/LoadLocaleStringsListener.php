<?php

namespace core\components\locales\eventlisteners;

use \core\eventlisteners\AbstractListener;
use core\components\locales\utils\LocaleLoader;

class LoadLocaleStringsListener extends AbstractListener
{
    public function on_request_start($filename) {
     
        $config = $this->httpRequest->getAttribute('langFilesList');
        if(is_null($config)) {
           
            return new LocaleLoader($filename);
        }
       
        $loader = new LocaleLoader($filename);
        
        foreach($config as $filename) {
            try{
                $loader->loadFile($this->getFilepath($filename . '.php'));
            }catch(\Exception $e) {
                $this->logger->addError($e->getMessage());
            }
        }
    
        $this->httpRequest->setAttribute('langFiles', $loader);
    }
    
    private function getFilepath($filename) {
        $locale = $this->getDefaultLocale();        
        return __SITE_PATH . DIRECTORY_SEPARATOR  . str_replace('*', $locale['locale'], $filename);
    }
}