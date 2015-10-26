<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\models;

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
class ContactAuthorizationModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ContactAuthorization';
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
            'Contacts_id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $contactAuthorization = array('roles' => '');
        if (is_array($data) && array_key_exists('ContactAuthorization', $data)) {
            $contactAuthorization = current($data['ContactAuthorization']);
        }

        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');

        $roles = explode('|', $contactAuthorization['roles']);
        if (is_null($roles)) {
            $roles = array();
        }

        return array('roles' => $roles, 'ContactTypes' => $contactTypes, 'Contact' => array('id' => $id));
    }

    public function load($id) {

        $params = array(
            'Contacts_id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if (!is_null($data) && array_key_exists('ContactAuthorization', $data)) {
            $contactAuthorization = current($data['ContactAuthorization']);
        }
        return $contactAuthorization;
    }

    public function saveCredentials($id) {

        $params = $this->httpRequest->getPost();
        $member = $this->httpRequest->getAttribute('components\\contacts\\models\\ContactAuthorizationModel');

        $params['ContactAuthorization']['password'] = crypt($params['ContactAuthorization']['password']);
        $password = new Password();
        $params['ContactAuthorization']['passwordHistory'] = $password->formatPasswordHistory($params['ContactAuthorization']['password'], $member);
        $params['ContactAuthorization']['Contacts_id'] = $id;
        unset($password);
        unset($params['ContactAuthorization']['passwordConfirm']);

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['ContactAuthorization']);

        return $params['ContactAuthorization'];
    }

    public function unlock($id) {

        $params = array();
        $params['ContactAuthorization']['status'] = 'active';
        $params['ContactAuthorization']['failedLogins'] = '0';
        $params['ContactAuthorization']['password'] = crypt($params['ContactAuthorization']['password']);
        $password = new Password();
        $params['ContactAuthorization']['passwordHistory'] = $password->formatPasswordHistory($params['ContactAuthorization']['password'], $member);
        $params['ContactAuthorization']['Contacts_id'] = $id;
        unset($password);
        unset($params['ContactAuthorization']['passwordConfirm']);

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'save', $params['ContactAuthorization']);

        return $params['ContactAuthorization'];
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
