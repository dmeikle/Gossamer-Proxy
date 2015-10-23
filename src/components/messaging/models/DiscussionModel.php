<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of DiscussionModel
 *
 * @author Dave Meikle
 */
class DiscussionModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Discussion';
        $this->tablename = 'MessagingDiscussions';
    }

    public function listallByClaim($claimId, $locationId) {

        $params = array(
            'Claims_id' => intval($claimId)
        );
        //if we've specified a location then only show for that unit number
        if (intval($locationId) > 0) {
            $params['ClaimsLocations_id'] = intval($locationId);
        }

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        $data['claimId'] = intval($claimId);
        $data['locationId'] = intval($locationId);

        return $data;
    }

}
