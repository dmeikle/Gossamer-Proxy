<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\security\handlers;

use core\services\ServiceInterface;
use core\datasources\DatasourceAware;
use Monolog\Logger;
use libraries\utils\Container;
use libraries\utils\YAMLParser;
use libraries\utils\URISectionComparator;

/**
 * AuthorizationHandler - placeholder - not implemented
 *
 * @author Dave Meikle
 */
class AuthorizationHandler extends DatasourceAware implements ServiceInterface {

    protected $container = null;
    protected $manager = null;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
        $this->loadNodeConfig();
    }

    /**
     * main method called. calls the provider and gets the provider to
     * authenticate the user
     *
     * @return type
     */
    public function execute() {

        $this->container->set('securityContext', $this->securityContext);

        if (is_null($this->node) || !array_key_exists('authorization', $this->node)) {

            return;
        }
        if (array_key_exists('security', $this->node) && (!$this->node['security'] || $this->node['security'] == 'false')) {

            return;
        }

        $token = $this->getToken();
        try {

            $this->manager->authorize($this->securityContext);

        } catch (\Exception $e) {
            echo json_encode(array('code'=>$e->getCode(), 'message' => $e->getMessage()));
            die;
        }
    }

    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function setParameters(array $params) {

        $this->securityContext = $params['security_context'];
        $this->manager = $params['authorization_manager'];
    }

    /**
     * loads the firewall configuration
     *
     * @return empty|array
     */
    private function loadNodeConfig() {

        $loader = new YAMLParser($this->logger);
        $loader->setFilePath(__SITE_PATH . '/app/config/firewall.yml');
        $config = $loader->loadConfig();
        unset($loader);

        $parser = new URISectionComparator();
        $key = $parser->findPattern($config, __URI);
        unset($parser);

        if (empty($key)) {
            return;
        }

        $this->node = $config[$key];
    }

    /**
     * accessor
     *
     * @return SecurityToken
     */
    protected function getToken() {
        return $this->manager->generateEmptyToken();
    }
}
