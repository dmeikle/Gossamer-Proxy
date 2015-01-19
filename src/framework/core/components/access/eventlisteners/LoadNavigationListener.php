<?php

namespace core\components\access\eventlisteners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLParser;
use libraries\utils\YamlListParser;

/**
 * Description of LoadNavigationListeners
 *
 * @author davem
 */
class LoadNavigationListener extends AbstractListener{
    
    
    
    public function on_response_start($params) {
   
        $accessNode = $this->httpRequest->getAttribute('AccessNode');
       
        $userRoles = $this->getUserAccessRoles();  
        
        $navigationNodes = $this->loadNavigation();        
             
        $navigationItems = $this->loadNavigationElements($navigationNodes, $userRoles); 
        $this->httpResponse->setAttribute('NAVIGATION', $navigationItems);
       
    }
    
    private function getUserAccessRoles() {
        $token = unserialize(getSession('_security_secured_area'));
        if(is_null($token) || !$token) {
            return array('IS_ANONYMOUS');
        }
       
        $user = $token->getClient();
  
        return $user->getRoles();
    }
    
    private function loadNavigationElements(array $config, array $userRoles) {
        $parser = new YamlListParser();
        
        return $parser->parseList($config, $userRoles, 'display_roles');
    }
    
    private function loadNavigation() {
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/navigation-display.yml');
        
        return $loader->loadConfig();       
    }
}
