<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\caching\eventlisteners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;

/**
 * LoadCachedRenderedPageListener
 *
 * saves a rendered page to cache if it does not require passed parameters
 *
 * looks for 'staticCache: true' in the node config
 *
 * @author Dave Meikle
 */
class SaveRenderedPageToCacheListener extends AbstractCachableListener {

    public function on_render_complete(Event $event) {

        if (!$this->isCachablePage()) {

            return;
        }

        //CP-238 - added agent type for segregating cache based on mobile, tablet and desktop
        $filepath = 'pages' . DIRECTORY_SEPARATOR . __YML_KEY . $this->getAgentTypesAsKeyString();

        $params = $event->getParams();
        $this->saveValuesToCache($filepath, $params['renderedPage']);
    }

    private function isCachablePage() {
        $nodeConfig = $this->httpRequest->getNodeConfig();

        if (!array_key_exists('staticCache', $nodeConfig) || $nodeConfig['staticCache'] != true) {
            return false;
        }

        return true;
    }

}
