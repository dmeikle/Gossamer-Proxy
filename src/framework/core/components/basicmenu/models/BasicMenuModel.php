<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\basicmenu\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\YAMLParser;
use libraries\utils\YamlListParser;

class BasicMenuModel extends  AbstractModel 
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = '';
        $this->tablename = '';        
    }

  
    
    /**
     * loads the navigation items from the yml config
     * 
     * @return array
     */
    protected function loadNavigation() {
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__CONFIG_PATH . '/navigation-display.yml');

        return $loader->loadConfig();
    }
    
    public function view() {
        $userRoles = $this->getUserAccessRoles();

        $navigationNodes = $this->loadNavigation();

        return $this->loadNavigationElements($navigationNodes, $userRoles);
       
    }
    
    /**
     * returns the specified user access roles for a current user
     * 
     * @return array
     */
    protected function getUserAccessRoles() {
        $token = unserialize(getSession('_security_secured_area'));
        if (is_null($token) || !$token) {
            return array('IS_ANONYMOUS');
        }

        $user = $token->getClient();

        return $user->getRoles();
    }
    
    /**
     * parses the allowable menu items
     * 
     * @param array $config
     * @param array $userRoles
     * 
     * @return array
     */
    protected function loadNavigationElements(array $config, array $userRoles) {
        $parser = new YamlListParser();

        return $parser->parseList($config, $userRoles, 'display_roles');
    }
}
