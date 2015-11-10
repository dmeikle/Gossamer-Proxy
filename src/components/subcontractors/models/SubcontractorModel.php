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
use Gossamer\CMS\Forms\FormBuilderInterface;

class SubcontractorModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Subcontractor';
        $this->tablename = 'subcontractors';
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

    public function searchContact($projectAddressId, $unitNumber) {
        $params = array('ProjectAddresses_id' => $projectAddressId, '');

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']);

        return $this->formatResults(current($data['ProjectAddresses']));
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
