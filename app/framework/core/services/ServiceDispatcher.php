<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\services;

use Monolog\Logger;
use libraries\utils\YAMLParser;
use core\services\ServiceManager;

/**
 * similar to an EventDispatcher, this class will create all services needed
 * for injection into any bootstrap or other services. This way a service starting
 * up can have any required objects created for it on the fly.
 *
 * @author Dave Meikle
 */
class ServiceDispatcher {

    private $logger = null;
    private $config = array();
    private $key = null;

    /**
     * 
     * @param Logger $logger
     * @param YAMLParser $parser
     */
    public function __construct(Logger $logger, YAMLParser $parser) {
        $this->logger = $logger;
        $this->loadConfigurations($parser);
        $this->loadKeyFromFirewallConfiguration($parser);
    }

    /**
     * load the configuration files
     * 
     * @param YAMLParser $parser
     */
    private function loadConfigurations(YAMLParser $parser) {

        $subdirectories = $this->getDirectoryList();

        //first load the system service configurations
        $parser->setFilePath(__SITE_PATH . '/app/config/services.yml');
        $config = $parser->loadConfig();

        if (is_array($config)) {
            $this->config[] = $config;
        }
        //now load all the component configurations
        foreach ($subdirectories as $folder) {
            $parser->setFilePath($folder . '/config/services.yml');
            $config = $parser->loadConfig();

            if (is_array($config)) {
                $this->config[] = $config;
            }
        }
    }

    private function loadKeyFromFirewallConfiguration(YAMLParser $parser) {
        $firewall = new Firewall($this->logger);
        $this->key = $firewall->getFirewallKey($parser);
        //echo "key ".$this->key.'<br>';
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
        if ($handle = opendir(__SITE_PATH . '/src/framework/core/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/src/framework/core/components/' . $file;
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
