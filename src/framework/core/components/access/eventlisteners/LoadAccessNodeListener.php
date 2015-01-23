<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\access\eventlisteners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLParser;
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use libraries\utils\URISectionComparator;

/**
 * loads the configuration based on the current URI
 *
 * @author Dave Meikle
 */
class LoadAccessNodeListener extends AbstractListener {

    private $config = null;

    /**
     * 
     * @param Logger $logger
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     */
    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        parent::__construct($logger, $httpRequest, $httpResponse);
        $this->loadAccessNode();
    }

    /**
     * 
     * @param void $params
     */
    public function on_request_start($params) {
        $this->httpRequest->setAttribute('AccessNode', $this->config);
    }

    /**
     * loads the configuration of the yml file
     * 
     * @return array
     */
    private function loadConfig() {
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/navigation-access.yml');

        return $loader->loadConfig();
    }

    /**
     * loads the current access configuration node based on current URI
     * 
     * @return void
     */
    private function loadAccessNode() {
        $config = $this->loadConfig();

        $parser = new URISectionComparator();
        $key = $parser->findPattern($config, __URI);
        if (!$key) {
            return;
        }
        if (array_key_exists($key, $config)) {
            $this->config = $config[$key];
        }
    }

}
