<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractCachableListener;

/**
 * LoadCachedSearchResultsFilter
 *
 * @author Dave Meikle
 */
class LoadCachedSearchResultsListener extends AbstractCachableListener {

    public function on_request_start($params) {

    }

    protected function getKey($params = null) {
        $params = $this->httpRequest->getQueryParameters();

        return 'search/staff_' . $params['name'];
    }

}
