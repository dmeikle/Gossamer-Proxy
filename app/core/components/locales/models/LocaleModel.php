<?php

namespace core\components\locales\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of LocaleModel
 *
 * @author Dave Meikle
 */ 
class LocaleModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Locale';
        $this->tablename = 'locales';        
    }
    
    public function change() {
        $params = $this->httpRequest->getPost();
        $this->setDefaultLocale($params['locale']);
    }
    
    public function setDefaultLocale($locale) {
       
        $userPreferences = getSession('userPreferences');
       
        if(is_null($userPreferences) || !is_array($userPreferences)) {
            $userPreferences = array();            
        }
        $locales = $this->httpRequest->getAttribute('locales');
        $userPreferences['defaultLocale'] = $locales[$locale];
        setSession('userPreferences', $userPreferences);      
    }
}