<?php
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
