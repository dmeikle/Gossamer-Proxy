<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use core\eventlisteners\Event;
use Gossamer\CMS\Forms\FormBuilderInterface;

class StaffEmergencyContactModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'StaffEmergencyContact';
        $this->tablename = 'staffemergencycontacts';
    }

    public function saveContact($staffId, $contactId) {

        $params = $this->httpRequest->getPost();

        $params[$this->entity]['Staff_id'] = intval($staffId);
        $params[$this->entity]['id'] = intval($contactId);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);

        return $data;
    }

    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {

        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        $defaultLocale = $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listStaff', $params);

        if (is_array($data) && array_key_exists(ucfirst($this->entity) . 'sCount', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->entity) . 'sCount'], $offset, $rows);
        }

        return $data;
    }

    private function formatArray(array $result) {
      
        $retval = array();
        foreach ($result as $row) {
            if(count($row) < 1) {
                continue;
            }
            $retval[$row['id']] = $row['name'];
        }
        return $retval;
    }

    public function login() {
        //this is required for the login system - do not delete!
    }

    public function getFormWrapper() {

        return $this->entity;
    }

    
     /**
     * queries the datasource and deletes the record
     * 
     * @param type $offset
     * @param type $rows
     * 
     * @return array
     */
    public function deleteContact($staffId, $contactId) {
        $params = array(
            'Staff_id' => intval($staffId),
            'id' => intval($contactId)
        );

        return $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
    }
    
}
