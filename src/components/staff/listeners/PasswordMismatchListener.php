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
use components\staff\models\StaffModel;
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

        $staff = new StaffModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();
        die('here');
        $datasource = $this->getDatasource($staff);

        $rawResult = $datasource->query('post', $staff, 'incrementfailedlogin', array('Staff_id' => intval($params[0])));

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_login_failed', array());
    }

}
