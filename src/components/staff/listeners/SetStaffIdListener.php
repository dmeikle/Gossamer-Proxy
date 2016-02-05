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

use core\eventlisteners\AbstractListener;

/**
 * SetStaffIdListener
 *
 * @author Dave Meikle
 */
class SetStaffIdListener extends AbstractListener {

    public function on_request_start($params) {
        $params = $this->httpRequest->getParameters();

        $result['id'] = intval($params[0]);

        $this->httpRequest->setAttribute('Staff', $result);
    }

}
