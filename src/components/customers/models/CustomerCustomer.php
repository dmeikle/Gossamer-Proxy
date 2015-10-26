<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\users\lib\Password;

/**
 * Description of UserAuthorizationModel
 *
 * @author Dave Meikle
 */
class CustomerAuthorizationModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'CustomerAuthorization';
        $this->tablename = 'contactauthorizations';
    }

    public function savePermissions($id) {

        $params = $this->httpRequest->getPost();
        if (intval($id) > 0) {
            $params['contact']['id'] = intval($id);
            $params['userAuthorizations']['id'] = intval($id);
        }

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveAuthorizations', $params['userAuthorizations']);

        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'save_success', new Event('save_success', $params));

        return array();
    }

    public function edit($id) {

        $params = array(
            'Customers_id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $contactAuthorization = array('roles' => '');
        if (is_array($data) && array_key_exists('CustomerAuthorization', $data)) {
            $contactAuthorization = current($data['CustomerAuthorization']);
        }

        $contactTypes = $this->httpRequest->getAttribute('CustomerTypes');

        $roles = explode('|', $contactAuthorization['roles']);
        if (is_null($roles)) {
            $roles = array();
        }

        return array('roles' => $roles, 'CustomerTypes' => $contactTypes, 'Customer' => array('id' => $id));
    }

    public function load($id) {

        $params = array(
            'Customers_id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if (!is_null($data) && array_key_exists('CustomerAuthorization', $data)) {
            $contactAuthorization = current($data['CustomerAuthorization']);
        }
        return $contactAuthorization;
    }

    public function saveCredentials($id) {

        $params = $this->httpRequest->getPost();
        $member = $this->httpRequest->getAttribute('components\\Customer\\models\\CustomerAuthorizationModel');

        $params['CustomerAuthorization']['password'] = crypt($params['CustomerAuthorization']['password']);
        $password = new Password();
        $params['CustomerAuthorization']['passwordHistory'] = $password->formatPasswordHistory($params['CustomerAuthorization']['password'], $member);
        $params['CustomerAuthorization']['Customers_id'] = $id;
        unset($password);
        unset($params['CustomerAuthorization']['passwordConfirm']);

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['CustomerAuthorization']);

        return $params['CustomerAuthorization'];
    }

    public function unlock($id) {

        $params = array();
        $params['CustomerAuthorization']['status'] = 'active';
        $params['CustomerAuthorization']['failedLogins'] = '0';
        $params['CustomerAuthorization']['password'] = crypt($params['CustomerAuthorization']['password']);
        $password = new Password();
        $params['CustomerAuthorization']['passwordHistory'] = $password->formatPasswordHistory($params['CustomerAuthorization']['password'], $member);
        $params['CustomerAuthorization']['Customers_id'] = $id;
        unset($password);
        unset($params['CustomerAuthorization']['passwordConfirm']);

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['CustomerAuthorization']);

        return $params['CustomerAuthorization'];
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
