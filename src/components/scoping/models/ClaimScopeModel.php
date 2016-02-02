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

class ClaimScopeModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ClaimScope';
        $this->tablename = 'claimscopes';
    }

    public function search(array $term) {
        $params = array('directive::ORDER_BY' => key($term), 'directive::DIRECTION' => 'DESC', 'directive::LIMIT' => '50', 'directive::OFFSET' => '0');
        $params = array_merge($params, $term);
//        pr($term);
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_SEARCH, $params);

        return $data;
    }

}
