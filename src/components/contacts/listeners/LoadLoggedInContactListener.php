<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\listeners;

use core\eventlisteners\LoadItemListener;

/**
 * Description of LoadStaffListener
 *
 * @author Dave Meikle
 */
class LoadLoggedInContactListener extends LoadItemListener {

    protected function getParameters() {

        $params = $this->httpRequest->getParameters();

        return array('id' => $this->getLoggedInStaffId());
    }

}
