<?php


namespace core\system;

use Monolog\Logger;
use components\validation\exceptions\RedirectKeyNotFoundException;
use libraries\utils\YAMLKeyParser;


/**
 * Description of Router
 *
 * @author davem
 */
class Router {
    
    private $logger = null;
    
    public function __construct(Logger $logger = null) {
        $this->logger = $logger;
    }
    
    public function redirect($ymlkey) {
        $redirectUrl = $this->getURLByYamlKey($ymlkey);
        if(is_null($redirectUrl)) {
                throw new RedirectKeyNotFoundException('Validation Fail redirect key not found');
            }
        if(!is_null($this->logger->addDebug('redirecting to ' . $redirectUrl)));
        /* Redirect browser */
        header("Location: /$redirectUrl");
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }
    
    private function getURLByYamlKey($ymlkey) {
        $loader = new YAMLKeyParser($this->logger);
        $node = $loader->getNodeByKey($ymlkey, 'routing');

        if(!is_null($node) && count($node) > 0) {
            return $node['pattern'];
        }
    }
   
   
}
