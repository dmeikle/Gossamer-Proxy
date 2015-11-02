<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scheduling\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class StaffSchedulingModel extends AbstractModel {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'StaffScheduling';
        $this->tablename = 'staffscheduling';
    }

    public function getSchedule(array $dateRange) {

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $dateRange);

        return $data;
    }

}
