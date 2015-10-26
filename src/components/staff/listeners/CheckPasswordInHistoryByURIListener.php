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
use components\users\lib\Password;
use core\system\Router;
use components\staff\models\StaffTempPasswordModel;

/**
 *
 * @requires: LoadStaffListener called first to make loaded Staff available
 *
 * @author Dave Meikle
 */
class CheckPasswordInHistoryByURIListener extends AbstractListener {

    public function on_entry_point(Event $event = null) {

        $params = $this->httpRequest->getParameters();
        $postedParams = $this->httpRequest->getPost();

        $model = new StaffTempPasswordModel($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource('components\staff\models\StaffTempPasswordModel');

        $staffAuthorization = $datasource->query('get', $model, 'GetLoginByUri', array('uri' => $params[0]));

        $password = new Password();
        if (!array_key_exists('StaffAuthorization', $staffAuthorization) || count($staffAuthorization['StaffAuthorization'][0]) < 1) {
            $this->httpRequest->setAttribute('result', 'false');

            return;
        }
        if ($password->checkPasswordExists($postedParams['StaffTempPassword']['password'], $staffAuthorization['StaffAuthorization'][0]['passwordHistory'])) {
            if ($this->listenerConfig['params']['failkey'] == 'false') { //don't do a redirect, just throw an error
                throw new \exceptions\JSONException($this->getString('VALIDATION_PASSWORD_IN_HISTORY'), 605);
            }
            setSession('ERROR_RESULT', array('StaffAuthorization' => array('password' => 'VALIDATION_PASSWORD_IN_HISTORY')));
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());

            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey'], array($params[0]));
        }
        unset($password);

        $this->httpRequest->setAttribute('result', 'true');
    }

    private function formatPostedArrayforFramework() {
        $retval = array();
        $key = key($this->httpRequest->getPost());
        $retval[$key][] = current($this->httpRequest->getPost());

        return $retval;
    }

}
