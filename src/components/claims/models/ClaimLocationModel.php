<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of ClaimLocationModel
 *
 * @author Dave Meikle
 */
class ClaimLocationModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ClaimLocation';
        $this->tablename = 'claimslocations';
    }

    public function saveRoom($locationId, $roomId) {
        $params = $this->httpRequest->getPost();


        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['rooms']);


        return $data;
    }

    public function viewLocation($claimId, $locationId) {

        $params = array('Claims_id' => $claimId, 'id' => $locationId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        return $data;
    }

    public function listLocationsByClaimId($claimId) {

        $params = array('Claims_id' => $claimId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return $data;
    }

    /**
     * listallByProjectAddress - assumes you have already filtered to ensure
     *                          requester has permission to view this address
     *
     * @param type $addressId
     * @param type $offset
     * @param type $limit
     *
     * @return array
     */
    public function listallByProjectAddress($addressId, $offset, $limit) {
        $params = $this->httpRequest->getQueryParameters();
        $params['ProjectAddresses_id'] = $addressId;
        $params['directive::OFFSET'] = $offset;
        $params['directive::LIMIT'] = $limit;

        return $this->dataSource->query(self::METHOD_GET, $this, 'listbyaddress', $params);
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
