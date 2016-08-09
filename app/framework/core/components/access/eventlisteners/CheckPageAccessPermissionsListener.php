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
use core\components\security\core\Client;
use core\eventlisteners\Event;

/**
 * CheckPageAccessPermissionsListener
 *
 * @author Dave Meikle
 */
class CheckPageAccessPermissionsListener extends AbstractListener {

    use \libraries\utils\traits\LoadConfigFile;

    public function on_entry_point($params) {

        $permissionsConfig = $this->loadPermissionsConfig();

        if (is_null($permissionsConfig) || !array_key_exists('access', $permissionsConfig)) {
            return; //no need, there's no spec in the permissions.yml for this
        }

        $this->checkPermissions($permissionsConfig);
    }

    private function checkPermissions(array $permissionsConfig) {
        $client = $this->getClient();
        if (is_null($client)) {
            $this->eventDispatcher->dispatch('all', 'unauthorized_access', new Event());
        }

        $checkByRoles = $this->checkPermissionsByRoles($client, $permissionsConfig);
        if ($checkByRoles) {
            return true;
        }

        //still here? check to see if we can go by specific userId
        if (!$this->checkPermissionsById($client, $permissionsConfig)) {
            $this->eventDispatcher->dispatch('all', 'unauthorized_access', new Event());
        }
    }

    private function checkPermissionsById(Client $client, array $permissionsConfig) {

        if (array_key_exists('access', $permissionsConfig) && array_key_exists('self', $permissionsConfig['access'])) {

            if ($permissionsConfig['access']['self'] != true) {

                return false;
            }
        }
        $pageId = $this->getId();

        return ($client->getId() == $pageId);
    }

    private function checkPermissionsByRoles(Client $client, array $permissionsConfig) {

        if (array_key_exists('access', $permissionsConfig) && array_key_exists('roles', $permissionsConfig['access'])) {
            $foundRoles = array_intersect($permissionsConfig['access']['roles'], $client->getRoles());

            if (count($foundRoles) > 0) {
                return true;
            }
        }

        return false;
    }

    private function loadPermissionsConfig() {
        $config = $this->loadCachedComponentConfig(__YML_KEY, 'permissions_config', 'permissions');

        if (array_key_exists(__YML_KEY, $config)) {
            return $config[__YML_KEY];
        } else {
            return null;
        }
    }

    protected function getId() {
        $params = $this->httpRequest->getParameters();

        return $params[0];
    }

}
