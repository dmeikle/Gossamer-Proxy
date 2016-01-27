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

class CustomerModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Customers';
        $this->tablename = 'customers';
    }

    public function login() {

    }

    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {
        return parent::listall($offset, $rows, 'listCustomers');
    }

    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['Customer']['id'] = intval($id);

        $locale = $this->getDefaultLocale();
        $params['Customer']['locale'] = $locale['locale'];

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveCustomer', $params['Customer']);

        return array('Customer' => $data['Customer'][0], 'roles' => array());
    }

    public function edit($id) {

        $params = array('id' => $id);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if (is_array($data) && array_key_exists('Customer', $data)) {
            $data['Customer'] = current($data['Customer']);
        } else {
            $data['Customer'] = array();
        }

        $contactTypes = $this->httpRequest->getAttribute('CustomerTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);

        //$contactTypes = $this->httpRequest->getAttribute('CustomerTypes'); -pasted in for when this is a loaded list

        $data['CustomerTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list

        return $data;
    }

    private function pruneArrayBeforeFormatting(array $result) {
        $retval = array();

        foreach ($result as $row) {
            $retval[$row['CustomerTypes_id']] = $row['contactType'];
        }

        return $retval;
    }

    public function view() {

        $params = array('id' => $this->getLoggedInStaffId());

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        if (is_array($data) && array_key_exists('Customer', $data)) {
            $data['Customer'] = current($data['Customer']);
        }
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function findByEmail($email) {
        $params = array('email' => $email);

        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    }

}
