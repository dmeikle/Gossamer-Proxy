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
use core\eventlisteners\Event;
use core\system\Router;

/**
 * Description of StatusLockedListener
 *
 * @author Dave Meikle
 */
class StatusLockedListener extends AbstractListener {

    const MAX_LOGIN_FAILURES = 6;

    public function on_login_status_locked(Event $event) {

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_status_locked', array());
    }

}
