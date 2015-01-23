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


class YAMLCredentialsConfiguration 
{
    
    private $logger = null;
    
    private $config = null;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    private function loadConfig() {
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'credentials.yml');
        
        $this->config = $parser->loadConfig();
       
        unset($parser);
    }
    
    public function getNodeParameters($ymlKey) {
        $this->loadConfig();        
        
      
        $nodeParams = $this->getYMLNodeParameters($ymlKey);
       
        return $nodeParams;
        
    }
    

    private function getYMLNodeParameters($ymlKey) {
        
        return $nodeParams = $this->config[$ymlKey];       
    }
    
   
}
