<?php


namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of RolesNotSetListener
 *
 * @author davem
 */
class RolesNotSetListener extends AbstractListener{
    
    public function on_login_roles_not_set(Event $event = null) {
        die('roles not set');
        header('Location: /portal/roles');
        
        exit;
    }
}
