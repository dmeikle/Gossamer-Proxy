<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

use Monolog\Logger;
use Gossamer\Pesedget\Utils\YAMLParser;

/**
 * builds an instance of a connection and stores it for further use to avoid
 * redundant connection creation and handshakes
 * 
 */
class DatasourceFactory {

    private $datasources = null;

    /**
     * 
     * @param type $sourceName
     * @param Logger $logger
     * 
     * @return REST|MYSQL|MSSQL connection objects
     * 
     * @throws \Exception
     */
    public function getDatasource($sourceName, Logger $logger = null) {
        $datasources = $this->getDatasources();

        if (!array_key_exists($sourceName, $datasources)) {
            try {
                $ds = $this->buildDatasourceInstance($sourceName, $logger);
                $datasources[$sourceName] = $ds;
            } catch (\Exception $e) {
                $logger->addError($sourceName . ' is not a valid datasource');
                throw new \Exception($sourceName . ' is not a valid datasource', 580);
            }
        }

        return $datasources[$sourceName];
    }

    /**
     * 
     * @return REST|MYSQL|MSSQL connection objects
     */
    private function getDatasources() {
        if (is_null($this->datasources)) {
            $this->datasources = array();
        }

        return $this->datasources;
    }

    /**
     * creates a datasource based on the credentials.yml configuration
     * 
     * @param type $sourceName
     * @param Logger $logger
     * 
     * @return \core\datasources\datasourceClass
     */
    private function buildDatasourceInstance($sourceName, Logger $logger = null) {
        $parser = new YAMLParser($logger);
        $ymlFilePath = __SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'credentials.yml';
        $parser->setFilePath($ymlFilePath);
        $dsConfig = $parser->loadConfig();
        $sourceName = trim($sourceName, "<br>");

        $datasourceClass = $dsConfig[$sourceName]['class'];

        $datasource = new $datasourceClass($logger, null, $this->getCredentials($dsConfig[$sourceName]));
        unset($parser);
        $datasource->setDatasourceKey($sourceName);

        return $datasource;
    }

    private function getCredentials($config) {
        if(!array_key_exists('credentials', $config)) {
            return null;
        }

        return $config['credentials'];
    }

}
