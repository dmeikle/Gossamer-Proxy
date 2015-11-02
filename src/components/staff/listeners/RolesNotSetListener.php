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

/**
 * Description of RolesNotSetListener
 *
 * @author Dave Meikle
 */
class RolesNotSetListener extends AbstractListener {

    public function on_login_roles_not_set(Event $event = null) {
        header('Location: /admin/login/roles');

        exit;
    }

}
