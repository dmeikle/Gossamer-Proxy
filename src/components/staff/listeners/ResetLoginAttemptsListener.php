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
use components\staff\models\StaffPreferenceModel;
use core\eventlisteners\Event;

/**
 * Description of ResetLoginAttemptsListener
 *
 * @author Dave Meikle
 */
class ResetLoginAttemptsListener extends AbstractListener {

    public function on_login_success(Event $event) {
        $params = $event->getParams();
        $client = $params['client'];
        $model = new StaffPreferenceModel($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($model);

        $datasource->query("update StaffAuthorizations set failedLogins = 0 where username='" . $client->getCredentials() . "'");

        unset($datasource);
        unset($model);
    }

}
