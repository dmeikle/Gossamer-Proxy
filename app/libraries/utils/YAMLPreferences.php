<?php

namespace libraries\utils;

use libraries\utils\YAMLParser;
use Monolog\Logger;

class YAMLPreferences
{
    protected $ymlFilePath = null;

    protected $logger = null;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }


    public function loadConfig($filename) {
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . '/config/' . $filename . '.yml');

        return $parser->loadConfig();

    }


}
