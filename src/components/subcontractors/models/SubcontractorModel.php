<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\subcontractors\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class SubcontractorModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Subcontractor';
        $this->tablename = 'subcontractors';
    }

    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['ScopeRequest']['id'] = $id;

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['ScopeRequest']);

        //need this for drawing the next page
        $data['scopeRequestId'] = $data['ScopeRequest'][0]['id'];

        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);

        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list

        return $data;
    }

    public function saveContact($id) {
        $params = $this->httpRequest->getPost();

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);

        return $data;
    }

    public function loadContact($id) {

        $params = array('id' => $id);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        $contactTypes = $this->httpRequest->getAttribute('ContactTypes');
        $unformattedTypes = $this->pruneArrayBeforeFormatting($contactTypes);

        $data['ContactTypes'] = $this->formatSelectionBoxOptions($unformattedTypes, array()); //TODO: array should be a loaded list

        $data['scopeRequestId'] = $this->httpRequest->getQueryParameter('scopeRequestId');

        return $data;
    }

    private function pruneArrayBeforeFormatting(array $result) {
        $retval = array();

        foreach ($result as $row) {
            $retval[$row['SubcontractorTypes_id']] = $row['contractorType'];
        }

        return $retval;
    }

    public function searchContact($projectAddressId, $unitNumber) {
        $params = array('ProjectAddresses_id' => $projectAddressId, '');

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']);

        return $this->formatResults(current($data['ProjectAddresses']));
    }

}
