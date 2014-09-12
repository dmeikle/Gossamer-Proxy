<?php


namespace core\services;

use Monolog\Logger;
use libraries\utils\YAMLParser;
use libraries\utils\URIComparator;

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
    
    public function getFirewallKey(YAMLParser $parser) {
        $parser->setFilePath(__SITE_PATH . '/app/config/firewall.yml');
        $config = $parser->loadConfig(); 
        $comparator = new URIComparator();
        
        $key = $comparator->findPattern($config, __URI);
        if(array_key_exists('authentication', $config[$key])) {
            return $config[$key]['authentication'];
        }
        
        return null;
    }
}
