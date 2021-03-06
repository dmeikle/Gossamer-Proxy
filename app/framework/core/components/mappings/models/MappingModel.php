<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\mappings\models;

use core\AbstractModel;
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;

/**
 * Model for the db mappings
 *
 * @author Dave Meikle
 */
class MappingModel extends AbstractModel {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        $this->entity = 'Mapping';
        $this->tablename = 'mappings';
    }

}
