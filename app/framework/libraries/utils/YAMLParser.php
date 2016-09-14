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

use Symfony\Component\Yaml\Yaml;
use Monolog\Logger;

/**
 * parses the yml file
 *
 * @author Dave Meikle
 */
class YAMLParser {

    protected $ymlFilePath = null;
    protected $logger = null;

    /**
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger = null) {
        $this->logger = $logger;
    }

    /**
     * finds a node based on a uri pattern
     *
     * @param string $uri
     * @param string $searchFor
     *
     * @return array
     */
    public function findNodeByURI($uri, $searchFor) {
        $this->logger->addDebug('YAMLParser opening ' . $this->ymlFilePath);

        $config = $this->loadConfig();
        if (!is_array($config)) {
            return null;
        }

        if (array_key_exists($uri, $config) && array_key_exists($searchFor, $config[$this->getSectionKey($uri)])) {

            return $config[$this->getSectionKey($uri)][$searchFor];
        }
        return null;
    }

    /**
     * loads the config file
     *
     * @return array
     */
    public function loadConfig() {
        if (!file_exists($this->ymlFilePath)) {
            return false;
        }
        $contents = file_get_contents($this->ymlFilePath);
        if (!$contents) {
            return false;
        }
        return Yaml::parse($contents);
    }

    /**
     *
     * @param string $uri
     *
     * @return string
     */
    private function getSectionKey($uri) {

        $pieces = explode('/', strtolower($uri));
        $pieces = array_filter($pieces);

        return implode('_', $pieces);
    }

    /**
     * accessor
     *
     * @param string $ymlFilePath
     */
    public function setFilePath($ymlFilePath) {
        $this->ymlFilePath = str_replace('\\', '/', $ymlFilePath);
    }

}
