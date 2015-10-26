<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace components\contacts\listeners;

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
        $router->redirect('contacts_login_locked');
    }

}
