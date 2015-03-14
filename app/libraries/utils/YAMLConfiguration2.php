<?php

namespace libraries\utils;

use Monolog\Logger;
use exceptions\URINotFoundException;
use libraries\utils\YAMLParser;
use libraries\utils\URIComparator;

class YAMLConfiguration2
{
    private $logger = null;
    
    private $config = null;
    
    private $datasources = null;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    private function loadConfig($routingPath) {
      
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR  . $routingPath);
       
        
        $this->config = $parser->loadConfig();
        
        unset($parser);
    }
    
    
    public function getNodeParameters($uri) {
        if($uri == '/' || $uri == '') {
            $uri = 'default/index';
        }
        $routingPath = $this->getInitialRouting($uri);
     
        $this->loadConfig($routingPath);
        $explodedPath = explode('/', $routingPath);
     
        $ymlKey = $this->findConfigKeyByURIPattern($this->config, 'pattern',$uri);
        
        $namespace = $explodedPath[0] . '\\' . $explodedPath[1];
      
        $nodeParams = $this->getYMLNodeParameters($ymlKey);
        $nodeParams['namespace'] = $namespace;
        $nodeParams['ymlKey'] = $ymlKey;
        $nodeParams['componentFolder'] = $this->getComponentFolderName($nodeParams);
        
        return $nodeParams;
        
    }
    private function getComponentFolderName(array $params) {
        $component = $params['defaults']['component'];
        $tmp = explode('\\', $component);
        array_pop($tmp);//drop the component filename
        array_shift($tmp); //drop the parent folder name
        
        return implode('\\', $tmp);
    }
    
    public function getDatasource($ymlKey = null) {
        $pieces = explode('_', $ymlKey);
        if(is_null($ymlKey)) {
            return $this->datasources;
        }
        
        return $this->datasources[$pieces[0]]['datasource'];
    }
    
    /**
     * Step 1
     *
     * getInitialRouting     determines which of the routing files to refer to for config instructions
     * 
     * @param string    requestURI - the uri we are looking up
     * 
     * @return string   the filepath to use
     */
    public function getInitialRouting($requestURI) {
        $parser = new YAMLParser($this->logger);

        $pieces = array_filter(explode('/', $requestURI));

        $parser->setFilePath(__SITE_PATH . '/app/config/routing.yml');
        $chunk = array_shift($pieces);
        if($chunk == 'admin' || $chunk == 'portal' || $chunk == 'super') {
            $chunk = array_shift($pieces);//drop the admin for the routing file
        }
        $config = $parser->loadConfig(); 
    
        unset($parser);
        $this->datasources = $config;

        if(!array_key_exists($chunk, $config)) {
            throw new URINotFoundException($chunk . ' does not exist in YML configuration');
        }
        //return the first path
        foreach($config[$chunk] as $key => $path) {
          
            return $path;            
        }
        
    }
    
    //$config, 'pattern', '/users/list'
    /**
     * Step 2
     * 
     * findConfigKeyByURIPattern    loads the configuration, determines the ymlKey based
     *                              on the pattern node in YML against the matching URI.
     *                              returns the ymlkey as well as all uri pieces
     * 
     * @param array     configlist
     * @param string    the node we are searching for
     * @param string    the complete uri we are searching against
     */
    public function findConfigKeyByURIPattern($configList, $node, $uriPattern)
    {
        $comparator = new URIComparator();

        $uriConfig = $comparator->findPattern($configList, $uriPattern);
        unset($comparator);
       
        return $uriConfig;
    }
    

    private function getYMLNodeParameters($ymlKey) {  
        
        return $nodeParams = $this->config[$ymlKey];       
    }
    
}
