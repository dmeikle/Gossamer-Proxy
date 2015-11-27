<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;

use core\eventlisteners\AbstractListener;

/**
 * LoadQueryParamsListener
 *
 * @author Dave Meikle
 */
class LoadQueryParamsListener extends AbstractListener {

    public function on_filerender_start($params) {

        
        $params = $this->httpRequest->getParameters();
        $params['Claims_id'] = $params[0];
        $params['ClaimsLocations_id'] = $params[1];
        
        $this->httpRequest->setAttribute('Params', $params);
        
    }

    public function on_request_start($params) {
        $this->on_filerender_start($params);
    }

}
