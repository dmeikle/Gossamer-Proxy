<?php


namespace core\services;

use Monolog\Logger;
use libraries\utils\YAMLParser;
use libraries\utils\URISectionComparator;

/**
 * Description of Firewall
 *
 * @author Dave Meikle
 */
class Firewall {
    
    private $logger = null;
    
    
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    //TODO: add component config to this
    public function getFirewallKey(YAMLParser $parser) {
        $parser->setFilePath(__SITE_PATH . '/app/config/firewall.yml');
        $config = $parser->loadConfig(); 
        $comparator = new URISectionComparator();
        $key = $comparator->findPattern($config, __URI);
        if($key === false) {
            return null;
        }
        if(array_key_exists('authentication', $config[$key])) {
           
            return $config[$key]['authentication'];
        }
        
        return null;
    }
}
