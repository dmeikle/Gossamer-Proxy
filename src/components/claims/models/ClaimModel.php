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
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class ClaimModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Claim';
        $this->tablename = 'claims';
    }

    public function savePM($claimId) {
        $params = $this->httpRequest->getPost();

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveprojectmanager', $params['ProjectManager']);

        return $data;
    }

    public function search(array $params) {

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params);

        return $data;
    }

    public function searchByJobNumber(array $term) {

        $params = array('directive::ORDER_BY' => 'jobNumber', 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50', 'directive::OFFSET' => '0');
        $params = array_merge($params, $term);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_SEARCH, $params);

        return $data;
    }

    public function saveInitialJobsheet($claimId, $claimsLocationId) {
        $params = $this->httpRequest->getPost();
        $params['ClaimLocation']['Claims_id'] = intval($claimId);
        $params['ClaimLocation']['id'] = intval($claimsLocationId);
        $params['AffectedAreas']['Claims_id'] = intval($claimId);
        $params['AffectedAreas']['ClaimsLocations_id'] = intval($claimsLocationId);

        $data = $this->dataSource->query(self::METHOD_POST, $this, 'saveinitialjobsheet', $params);

        return $data;
    }

    public function get($claimId) {
        $locale = $this->getDefaultLocale();

        $params = array(
            'jobNumber' => $claimId,
            'locale' => $locale['locale']
        );
        if (intval($claimId) == $claimId) {
            //they're asking by id instead of jobNumber
            $params = array(
                'id' => $claimId,
                'locale' => $locale['locale']
            );
        }
        $claim = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        if (array_key_exists('Claim', $claim)) {
            return current($claim['Claim']);
        }

        return $claim;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function view($jobNumber) {

        $params = array('jobNumber' => $jobNumber);

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'summary', $params);

        return $data;
    }

    public function getInitialJobsheet($claimId, $claimsLocationId) {

        $params = array('Claims_id' => $claimId, 'ClaimsLocations_id' => $claimsLocationId);

        $locale = $this->getDefaultLocale();
        $params['locale'] = $locale['locale'];

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'getinitialjobsheet', $params);

        return $data;
    }

    /**
     * performs a save to the datasource
     *
     * @param int $id
     *
     * @return type
     */
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();
        $params[$this->entity]['ClaimPhases_id'] = $params[$this->entity]['currentClaimPhases_id'];

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);

        return $data;
    }

}
