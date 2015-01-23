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
        $siteConfig = $this->loadConfig(__SITE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'views.yml');
        
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

        $parser->setFilePath(__SITE_PATH . '/app/config/routing.yml');
        $chunk = array_shift($pieces);
        if($chunk == 'admin' || $chunk == 'portal') {
            $chunk = array_shift($pieces);//drop the admin for the routing file
        }
        $config = $parser->loadConfig(); 
  
        unset($parser);
        $this->datasources = $config;

        //if we haven't found anything matching see if we can simply return a default config
        if(!array_key_exists($chunk, $config)) {
            if(!array_key_exists('default', $config)) {
                throw new URINotFoundException($chunk . ' does not exist in YML configuration');  
            }
           
            return str_replace('routing', 'views',  $config['default']['component']);
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
    
}
