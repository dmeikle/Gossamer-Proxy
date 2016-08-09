<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils;

use libraries\utils\YAMLParser;
use Monolog\Logger;

/**
 * loads the preferences
 * 
 * @author Dave Meikle
 */
class YAMLPreferences {

    protected $ymlFilePath = null;
    protected $logger = null;

    /**
     * 
     * @param Logger $logger
     */
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * 
     * @param string $filename
     * 
     * @return array
     */
    public function loadConfig($filename) {
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . '/app/config/' . $filename . '.yml');

        return $parser->loadConfig();
    }

}
