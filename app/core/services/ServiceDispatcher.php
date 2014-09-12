<?php


namespace core\services;

use Monolog\Logger;
use libraries\utils\YAMLParser;
use core\services\ServiceManager;


/**
 * Description of ServiceDispatcher
 *
 * @author Dave Meikle
 */
class ServiceDispatcher {
    
    private $logger = null;
    
    private $config = array();
    
    private $key = null;
     
    
    public function __construct(Logger $logger,YAMLParser $parser) {
        $this->logger = $logger;
        $this->loadConfigurations($parser);
        $this->loadKeyFromFirewallConfiguration($parser);
    }
    
    private function loadConfigurations(YAMLParser $parser) {
       
        $subdirectories = $this->getDirectoryList();
        $serviceBootstraps = array();
        //first load the system service configurations
        $parser->setFilePath(__SITE_PATH . '/app/config/services.yml');
        $config = $parser->loadConfig(); 

        if(is_array($config)) {
            $this->config[] = $config;
        }   
        //now load all the component configurations
        foreach ($subdirectories as $folder) {       
            $parser->setFilePath($folder . '/config/services.yml');
            $config = $parser->loadConfig(); 

            if(is_array($config)) {
                $this->config[] = $config;
            }        
        }
    
    }
    
    private function loadKeyFromFirewallConfiguration(YAMLParser $parser) {
        $firewall = new Firewall($this->logger);
        $this->key = $firewall->getFirewallKey($parser);
       
        unset($firewall);
    }
    
    private function getDirectoryList() {
    
        $retval = array();
        if ($handle = opendir(__SITE_PATH . '/src/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/src/components/' . $file;
                }
            }
            closedir($handle);
        }
        if ($handle = opendir(__SITE_PATH . '/app/core/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/app/core/components/' . $file;
                }
            }
            closedir($handle);
        }

        return $retval;
    }
    
    public function dispatch(ServiceManager $serviceManager) {
        $serviceManager->executeService($this->key);
    }
}
