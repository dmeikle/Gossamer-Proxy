<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * SystemWidget
 *
 * @author Dave Meikle
 */
class WidgetModel extends AbstractModel{
    
    /**
     * 
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Widget';
        $this->tablename = 'widgets';
    }
}
