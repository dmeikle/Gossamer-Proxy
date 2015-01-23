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

use core\datasources\DataSourceInterface;
use Monolog\Logger;
use libraries\utils\YAMLParser;

class DatasourceFactory
{
    
    private $datasources = null;
    
    public function getDatasource($sourceName, Logger $logger) {
        $datasources = $this->getDatasources();
        
        if(!array_key_exists($sourceName, $datasources)) {            
            try{
                $ds = $this->buildDatasourceInstance($sourceName, $logger);            
                $datasources[$sourceName] = $ds;          
            }catch(\Exception $e) {
                $logger->addError($sourceName . ' is not a valid datasource');
                throw new \Exception($sourceName . ' is not a valid datasource', 580);            
            }
        }
        
        return $datasources[$sourceName];
    }
    
    private function getDatasources() {
        if(is_null($this->datasources)) {
            $this->datasources = array();
        }
        
        return $this->datasources;
    }
    
    private function buildDatasourceInstance($sourceName, Logger $logger) {
        $parser = new YAMLParser($logger);
        $ymlFilePath = __SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'credentials.yml';
        $parser->setFilePath($ymlFilePath);
        $dsConfig = $parser->loadConfig();
        $sourceName = trim($sourceName, "<br>");
        
        $datasourceClass = $dsConfig[$sourceName]['class'];

        $datasource = new $datasourceClass($logger);
        unset($parser);
        $datasource->setDatasourceKey($sourceName);
        
        return $datasource;
    }
}
