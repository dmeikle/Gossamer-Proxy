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

/**
 * Description of ClaimLocationModel
 *
 * @author Dave Meikle
 */
class ClaimLocationCommentModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

//        $this->entity = 'ClaimLocationComment';
//        $this->tablename = 'claimslocationcomments';
        $this->entity = 'ClaimsLocationNote';
        $this->tablename = 'claimslocationnotes';
    }

    public function listCommentsByJobnumber(array $params) {

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params[$this->entity]);

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
//        $params[$this->entity]['entryDate'] = Date("Y-m-d");

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        return $data;
    }

}
