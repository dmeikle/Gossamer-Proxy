<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scoping\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

class ScopeMaterialTakeoffModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ScopeMaterialTakeoff';
        $this->tablename = 'scopingmaterialtakeoffsheets';
    }

    public function getTakeoff($id) {

        return array();
    }

    public function editByLocation($claimsId, $claimsLocationsId) {
        $params = array(
            'Claims_id' => intval($claimsId),
            'ClaimsLocations_id' => intval($claimsLocationsId)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        return $data;
    }

    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params['Staff_id'] = $this->getLoggedInStaffId();
//        pr($params);
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
