<?php

namespace core\components\security\handlers;

use core\services\ServiceInterface;
use core\datasources\DatasourceAware;
use Monolog\Logger;
use libraries\utils\Container;
use libraries\utils\YAMLParser;
use libraries\utils\URISectionComparator;

/**
 * Description of AuthenticationHandler
 *
 * @author Dave Meikle
 */
class AuthenticationHandler extends DatasourceAware implements ServiceInterface{

    private $securityContext = null;
    
    private $securityManager = null;
    
    private $logger = null;
    
    private $container = null;
    
    private $node = null;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
        $this->loadNodeConfig();  
        //die('here');
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
    
    public function execute() {
      
        $this->container->set('securityContext', $this->securityContext);
      
        if(is_null($this->node) || !array_key_exists('authentication', $this->node)) {
           
            return;
        }
        if(array_key_exists('security', $this->node) && (!$this->node['security'] || $this->node['security'] == 'false')) {
         
            return;
        }
        $token = $this->getToken();
        try{
            $this->securityManager->authenticate($this->securityContext);
     
        }catch(\Exception $e) {
      
             header( 'Location: ' . $this->getSiteURL() . $this->node['fail_url'] ) ;
        }
        
      
        $this->container->set('securityContext', $this->securityContext);        
    }

    private function getSiteURL()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        
        return $protocol.$domainName;
    }
       
    private function loadNodeConfig() {
    
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/firewall.yml');        
        $config = $loader->loadConfig();
        unset($loader);        

        $parser = new URISectionComparator();
        $key = $parser->findPattern($config, __URI);
       
        unset($parser);
        if(empty($key)) {
            return;
        }
        $this->node = $config[$key];
        
    }
    
    public function setParameters(array $params) {
      
        $this->securityContext = $params['security_context'];
        $this->securityManager = $params['authentication_manager'];
    }

    protected function getToken() {
        return $this->securityManager->generateEmptyToken();
    }

}
