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

use core\eventlisteners\Event;
use core\eventlisteners\AbstractListener;

/**
 * UnauthorizedAccessListener
 *
 * @author Dave Meikle
 */
class UnauthorizedAccessListener extends AbstractListener {

    public function on_unauthorized_access(Event $params) {

        //for now throw an error
        throw new \Exception('you cannot see this page');
    }

}
