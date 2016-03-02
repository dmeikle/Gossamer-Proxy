<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use libraries\utils\YAMLPreferences;

/**
 * loads the default preferences for any user requests where we don't know
 * who they are. things like langage to use (en_US) etc...
 * 
 * @author Dave Meikle
 */
class LoadDefaultPreferencesListener extends AbstractListener {

    /**
     * 
     * @param type $params
     */
    public function on_entry_point($params) {

        $loader = new YAMLPreferences($this->logger);
        $config = $loader->loadConfig('defaultpreferences');

        $this->httpRequest->setAttribute('defaultPreferences', $config);
    }

}
