<?php

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
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'credentials.yml');
        
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
