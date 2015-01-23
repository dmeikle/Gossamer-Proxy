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

use filters\FilterChain;
use libraries\utils\Registry;
use exceptions\InvalidServerIDException;
use exceptions\UnauthorizedAccessException;
use entities\ServerAuthenticationToken;
use commands\GetCommand;
use libraries\utils\YAMLPreferences;

class LoadDefaultPreferencesListener extends AbstractListener
{


    public function on_entry_point($params) {

        $loader = new YAMLPreferences($this->logger);
        $config = $loader->loadConfig('defaultpreferences');
        
        $this->httpRequest->setAttribute('defaultPreferences', $config);
       
    }

}
