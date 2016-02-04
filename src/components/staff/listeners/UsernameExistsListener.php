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
use components\staff\models\StaffAuthorizationModel;
use core\system\Router;

/**
 * Description of UsernameExistsListener
 *
 * @author Dave Meikle
 */
class UsernameExistsListener extends AbstractListener {

    //CP-87 - change from request_start to entry_point
    public function on_entry_point(Event $event = null) {

        $staff = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $post = $this->httpRequest->getPost();

        $staffData = $post['StaffAuthorization'];
        $uriParams = $this->httpRequest->getParameters();
        $params = array('username' => $staffData['username']);
        $currentStaffId = intval($uriParams[0]);

        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');

        $results = $datasource->query('get', $staff, 'get', $params);

        if (is_array($results) && array_key_exists('StaffAuthorization', $results) && $this->isDifferentUser($currentStaffId, $results)) {
            if ($this->listenerConfig['params']['failkey'] == 'false') { //don't do a redirect, just throw an error
                throw new \exceptions\JSONException($this->getString('VALIDATION_USERNAME_EXISTS'), 605);
            }
            setSession('ERROR_RESULT', $this->formatErrorResult());
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());

            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey']);
        }

        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', NULL);
    }

    private function isDifferentUser($currentId, array $result) {
        $resultStaff = current($result['StaffAuthorization']);
        //staffauthorization does not yet exist for this user. possible imported from a list into Staff table only
        if (!array_key_exists('Staff_id', $result)) {
            return false;
        }

        return (intval($currentId) != $resultStaff['Staff_id']);
    }

    private function formatErrorResult() {
        return array(
            'StaffAuthorization' => array('username' => 'VALIDATION_USERNAME_EXISTS')
        );
    }

    private function formatPostedArrayforFramework() {
        $retval = array();
        $key = key($this->httpRequest->getPost());
        $retval[$key][] = current($this->httpRequest->getPost());

        return $retval;
    }

}
