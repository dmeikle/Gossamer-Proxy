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
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use libraries\utils\URISectionComparator;

/**
 * loads the configuration based on the current URI
 *
 * @author Dave Meikle
 */
class CheckPageAccessPermissionsListener extends AbstractListener {

    use \libraries\utils\traits\LoadConfigFile;

    /**
     *
     * @param void $params
     */
    public function on_entry_point($params) {

        $config = $this->loadAccessNode();

        //nothing to check
        if (is_null($config) || !array_key_exists('access', $config)) {

            return;
        }
        $client = $this->getClient();
        $roles = $client->getRoles();

        $matchingRoles = array_intersect($config['access']['roles'], $roles);

        if (count($matchingRoles) == 0) {
            throw new \exceptions\UserRolesNotPermittedException();
        }
    }

    /**
     * loads the current access configuration node based on current URI
     *
     * @return void
     */
    private function loadAccessNode() {
        $config = $this->loadCachedComponentConfig(__YML_KEY, 'navigation_access', 'permissions', true);

        if (array_key_exists(__YML_KEY, $config)) {
            return $config[__YML_KEY];
        }

        return null;
    }

}
