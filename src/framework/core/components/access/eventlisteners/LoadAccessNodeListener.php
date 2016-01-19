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
class LoadAccessNodeListener extends AbstractListener {

    use \libraries\utils\traits\LoadConfigFile;

    /**
     *
     * @param void $params
     */
    public function on_entry_point($params) {
        $config = $this->loadAccessNode();

        $this->httpRequest->setAttribute('AccessNode', $config);
    }

    /**
     * loads the current access configuration node based on current URI
     *
     * @return void
     */
    private function loadAccessNode() {
        $config = $this->loadCachedComponentConfig(__YML_KEY, 'navigation_access', 'permissions', true);

        $parser = new URISectionComparator();
        $key = $parser->findPattern($config, __URI);
        if (!$key) {
            return null;
        }

        if (array_key_exists($key, $config)) {
            return $config[$key];
        }
    }

}
