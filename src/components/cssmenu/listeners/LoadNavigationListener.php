<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\cssmenu\listeners;

use core\components\access\eventlisteners\LoadNavigationListener as BaseListener;
use libraries\utils\YAMLParser;

/**
 * LoadNavigationListener - Loads the navigation config for a user
 * to determine their available menu options
 *
 * @author Dave Meikle
 */
class LoadNavigationListener extends BaseListener {

    /**
     * returns the specified user access roles for a current user.
     * the rest of the logic is abstracted into the parent class
     *
     * @return array
     */
    protected function getUserAccessRoles() {

        $roles = $this->httpRequest->getAttribute('ROLES');

        if (!is_array($roles) || count($roles) == 0) {
            return array('IS_ANONYMOUS');
        }

        return $roles;
    }

    /**
     * loads the navigation items from the yml config
     *
     * @return array
     */
    protected function loadNavigation() {
        $loader = new YAMLParser($this->logger);

        if (array_key_exists('params', $this->listenerConfig) && array_key_exists('file', $this->listenerConfig['params'])) {
            if (!file_exists(__SITE_PATH . '/app/config/' . $this->listenerConfig['params']['file'] . '.yml')) {
                echo 'unable to load navigation config file<br>';
                return;
            }

            $loader->setFilePath(__SITE_PATH . '/app/config/' . $this->listenerConfig['params']['file'] . '.yml');
        } else {
            $loader->setFilePath(__SITE_PATH . '/app/config/navigation-display.yml');
        }
        return $loader->loadConfig();
    }

}
