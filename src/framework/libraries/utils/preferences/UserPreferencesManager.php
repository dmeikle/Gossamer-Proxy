<?php

namespace libraries\utils\preferences;

use libraries\utils\preferences\UserPreferences;
use core\http\HTTPRequest;
use core\http\CookieManager;

/**
 * Description of UserPreferencesManager
 *
 * @author davem
 */
class UserPreferencesManager {
    
    private $httpRequest = null;
    
    const COOKIE_NAME = 'user_preferences';
    
    public function __construct(HTTPRequest &$httpRequest) {
        $this->httpRequest = $httpRequest;
    }
    
    public function getPreferences() {
        $manager = new CookieManager();
        $preferences = $manager->getCookie(self::COOKIE_NAME);
        
        if(is_null($preferences)) {
          
            return null;
        }
        
        unset($manager);
        
        return $this->parseCookie($preferences);
    }
    
    public function savePreferences(array $preferences) {
        $manager = new CookieManager();
        
        $manager->setCookie(self::COOKIE_NAME, $preferences);
        unset($manager);
    }
    
    private function parseCookie(array $values) {
        $userPreferences = new UserPreferences();
             
        $this->setDefaultLocale($userPreferences, $values);
        $this->setNotificationTypes($userPreferences, $values);
        
        return $userPreferences;
    }
    
    public function setNotificationTypes(UserPreferences &$userPreferences, array $values) {
        if(!array_key_exists('NotificationType', $values)) {
            return null;
        }
        
        $notificationType = $values['NotificationType'];
        
        $userPreferences->setNotificationTypeId(intval($notificationType));
    }
    
    //we are using a cookie - cannot assume it's safe, so let's see what it holds
    private function setDefaultLocale(UserPreferences &$userPreferences, array $values) {
     
        $preferredLocale = $values['DefaultLocale'];
        $allowableLocales = $this->httpRequest->getAttribute('locales');
        
        //check to see if the value in the cookie is a valid locale in our list
        foreach($allowableLocales as $locale) {
            if($locale['locale'] == $preferredLocale) {
                $userPreferences->setDefaultLocale($preferredLocale);
                
                return true;
            }
        }
        
        //locale wasn't located. either the value in the cookie doesn't exist
        //or the cookie is corrupt
        return false;
    }
}
