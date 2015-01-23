<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\access\eventlisteners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLParser;
use libraries\utils\YamlListParser;

/**
 * LoadNavigationListener - Loads the navigation config for a user
 * to determine their available menu options
 *
 * @author Dave Meikle
 */
class LoadNavigationListener extends AbstractListener {

    /**
     *  entry point - this is called at the start of a response object 
     *  being drawn.
     * 
     * @param variant $params
     */
    public function on_response_start($params) {

        $accessNode = $this->httpRequest->getAttribute('AccessNode');

        $userRoles = $this->getUserAccessRoles();

        $navigationNodes = $this->loadNavigation();

        $navigationItems = $this->loadNavigationElements($navigationNodes, $userRoles);
        $this->httpResponse->setAttribute('NAVIGATION', $navigationItems);
    }

    /**
     * returns the specified user access roles for a current user
     * 
     * @return array
     */
    private function getUserAccessRoles() {
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
    private function loadNavigationElements(array $config, array $userRoles) {
        $parser = new YamlListParser();

        return $parser->parseList($config, $userRoles, 'display_roles');
    }

    /**
     * loads the navigation items from the yml config
     * 
     * @return array
     */
    private function loadNavigation() {
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/navigation-display.yml');

        return $loader->loadConfig();
    }

}
