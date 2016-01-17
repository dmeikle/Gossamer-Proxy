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

/**
 * LoadCachedRenderedPageListener
 *
 * loads a page from cache if it is safe to cache. Intended for 'static' files
 * that do no require sections loaded based on passed parameters
 *
 * @author Dave Meikle
 */
class LoadCachedRenderedPageListener extends AbstractCachableListener {

    public function on_entry_point($params) {

        if (!$this->isCachablePage()) {
            return;
        }
        //CP-238 - added agenttype for segregating cache for mobile, desktop and tablet
        $filepath = 'pages' . DIRECTORY_SEPARATOR . __YML_KEY . $this->getAgentTypesAsKeyString();

        $page = $this->getValuesFromCache($filepath, true);

        if ($page == false) {

            return;
        }
        $this->httpRequest->setAttribute('CACHED_PAGE_ON_ENTRY_POINT', $page);

//        print($page);
//        //no further processing required
//        exit;
    }

    private function isCachablePage() {
        $nodeConfig = $this->httpRequest->getNodeConfig();

        if (!array_key_exists('staticCache', $nodeConfig) || $nodeConfig['staticCache'] != true) {
            return false;
        }

        return true;
    }

}
