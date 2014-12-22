<?php

namespace core\components\access\eventlisteners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLParser;
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use libraries\utils\URISectionComparator;



/**
 * Description of LoadAccessNodeListener
 *
 * @author davem
 */
class LoadAccessNodeListener extends AbstractListener{
    
    private $config = null;
    
    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        parent::__construct($logger, $httpRequest, $httpResponse);
        $this->loadAccessNode();
    }
    
    public function on_request_start($params) {
        $this->httpRequest->setAttribute('AccessNode', $this->config);
    }
    
    private function loadConfig() {
        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/navigation-access.yml');
        
        return $loader->loadConfig();       
    }
    
    private function loadAccessNode() {
        $config = $this->loadConfig();
        
        $parser = new URISectionComparator();
        $key = $parser->findPattern($config, __URI);
        if(!$key) {
            return;
        }
        if(array_key_exists($key, $config)) {
            $this->config = $config[$key];
        }
        
    }
}
