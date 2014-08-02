<?php

namespace libraries\utils;

use Monolog\Logger;
use exceptions\URINotFoundException;
use libraries\utils\YAMLParser;

class YAMLViewConfiguration 
{
    private $logger = null;
    
    private $config = null;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    private function loadConfig($routingPath) {
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath($routingPath);
       
        return $parser->loadConfig();
    }
    
    public function getViewConfig($uri, $ymlKey) {
        $routingPath = $this->getInitialRouting($uri);
     
        $siteConfig = $this->loadConfig(__SITE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'views.yml');
        
        $this->config = $this->loadConfig(__SITE_PATH . DIRECTORY_SEPARATOR . $routingPath);
       
        $explodedPath = explode('/', $routingPath);
        $result = $this->getYMLNodeParameters($ymlKey);
        if(is_array($result)) {
            return array_merge($this->getYMLNodeParameters($ymlKey), $siteConfig);
        }

       
        return $siteConfig;
        
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
        $parser->setFilePath(__SITE_PATH . '/config/routing.yml');
        $chunk = array_shift($pieces);
        if($chunk == 'admin') {
            $chunk = array_shift($pieces);
        }
        $config = $parser->loadConfig(); 
        unset($parser);

        if(!array_key_exists($chunk, $config)) {
            throw new URINotFoundException($chunk . ' does not exist in YML configuration');
        }
        //return the first path
        foreach($config[$chunk] as $key => $path) {            
            return str_replace('routing', 'views', $path);            
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
       
        if(array_key_exists($ymlKey, $this->config)) {
            return $nodeParams = $this->config[$ymlKey]; 
        }              
    }
    
    private function iterateComponentConfigurations(Logger $logger, $filename, $node) {
       
        $retval = array();
        $parser = new YAMLParser($logger);

        $parser->setFilePath(__SITE_PATH . '/config/' . $filename .'.yml');
        
            $retval[] = $parser->findNodeByURI('all', $node); 
            //just in case it's a usercommand (not component) load any config for it here also
            $retval[] = $parser->findNodeByURI(__YML_KEY, $node); 
        
        $subdirectories = $this->getDirectoryList();
        foreach ($subdirectories as $folder) {
            $parser->setFilePath($folder . '/config/' . $filename . '.yml');
            $config = $parser->findNodeByURI(__YML_KEY, $node); 
           if(is_array($config)) {
                $retval[] = $config;
            }
            
        }
       
        $this->configs = $retval;
    }
}
