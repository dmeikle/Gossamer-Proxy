<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use core\system\Router;

/**
 * Description of PasswordMismatchListener
 *
 * @author Dave Meikle
 */
class PasswordMismatchListener extends AbstractListener {

    const MAX_LOGIN_FAILURES = 6;

    public function on_login_password_mismatch(Event $event) {
        $params = $event->getParams();
        $client = $params['client'];

        $datasource = $this->getDatasource('components\customers\models\CustomerAuthorizationModel');

        $datasource->execute("update CustomerAuthorizations set failedLogins = failedLogins + 1 where username='" . $client->getCredentials() . "'");

        //now check to see if we need to lock them down
        $result = $datasource->execute("select failedLogins from CustomerAuthorizations where username='" . $client->getCredentials() . "'");

        $failedLogins = current($result);
        $value = $failedLogins['failedLogins'];
        if ($value >= self::MAX_LOGIN_FAILURES) {
            $datasource->execute("update CustomerAuthorizations set status='locked' where username='" . $client->getCredentials() . "'");
        }

        unset($datasource);
        unset($model);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('Customer_login_failed');
    }

}
