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
use Gossamer\CMS\Forms\FormBuilderInterface;

class ContactInviteModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ContactInvite';
        $this->tablename = 'contactinvites';
    }

    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {
        return parent::listall($offset, $rows);
    }

    public function save($id) {

        $params = $this->httpRequest->getPost();
        //$params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['InviterContacts_id'] = $this->getLoggedInStaffId();

        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
    }

    public function edit($id) {

        $params = array('id' => intval($id), 'InviterContacts_id' => $this->getLoggedInStaffId());

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if (is_array($data) && array_key_exists($this->entity, $data)) {
            $data[$this->entity] = current($data[$this->entity]);
        }

        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
