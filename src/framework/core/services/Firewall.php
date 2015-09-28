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
use libraries\utils\URISectionComparator;

/**
 * the 'doorman' of the application. Determines which rules to run and when
 * based on the /app/config/firewall.yml file configuration.
 * 
 * configuration is as follows:
  admin_login_get: <-- the yml key for this file - not recognized across system
    pattern: admin/login <-- the URL
    security: false <-- turn security on for this URL? true|false
    methods: [GET] <-- only apply to GET methods - or any specified

  admin_login_submit:
    pattern: admin/login
    authentication: staff_login_auth <-- look in services.yml for staff_login_auth
    methods: [POST]

  admin_area2:
    pattern: /admin
    authentication: simple_auth <-- look in services.yml for simple_auth
    fail_url: admin/login
 * 
 * 
 * 
 * inside of services.yml:
  'staff_login_auth':
    'handler': 'core\components\security\handlers\AuthenticationHandler'
    'datasource': 'datasource3'
    'arguments':
        security_context: '@security_context'
        authentication_manager: '@authentication_stafflogin_manager'
 * 
 *
 * @author Dave Meikle
 */
class Firewall {

    private $logger = null;

    /**
     * 
     * @param Logger $logger
     */
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * loads the configuration from the firewall.yml file
     * no need to add component config to this method as we only
     * want 1 rule to permit access. Developer can put these rules
     * in 1 location only (the firewall.yml). The services.yml is
     * located in /app/config/ and all component directories where developer
     * can create services to run and be called by the firewall.
     * 
     * @param YAMLParser $parser
     * @return array|null
     */
    public function getFirewallKey(YAMLParser $parser) {
        
        $parser->setFilePath(__SITE_PATH . '/app/config/firewall.yml');
        $config = $parser->loadConfig();
        $comparator = new URISectionComparator();
        $key = $comparator->findPattern($config, __URI);
       
        if ($key === false) {
         
            return null;
        }
        
        if (array_key_exists('authentication', $config[$key])) {

            return $config[$key]['authentication'];
        }

        return null;
    }

}
