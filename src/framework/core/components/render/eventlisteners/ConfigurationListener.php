<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use libraries\utils\YAMLParser;

/**
 * ConfigurationListener
 *
 * this will load the configuration for a requested file
 * eg: language strings
 *
 * looks for a file called render.yml in the component config folder
 *
 * @author Dave Meikle
 */
class ConfigurationListener extends AbstractCachableListener {

    public function on_request_start($params) {
        list($widget, $file) = $this->httpRequest->getParameters();

        //first check the main routing to see where the component is located
        $renderPath = $this->loadPathFromMainRouting($widget);

        $config = $this->loadConfig($renderPath, $file);

        $this->httpRequest->setAttribute('RENDER_CONFIG', $config);
    }

    /**
     *
     * @param string $routingPath
     */
    private function loadConfig($routingPath, $file) {

        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . $routingPath);

        $config = $parser->loadConfig();

//set up any listeners that the file requires
      
        $this->loadListeners($config, $file);

        return $config[$file];
    }

    /**
     * loadPathFromMainRouting - determines which component to load the render.yml from
     *
     * @param type $widget
     * @return type
     *
     * @throws \Exception
     */
    private function loadPathFromMainRouting($widget) {
        $parser = new \libraries\utils\YAMLConfiguration($this->logger);
        $routingPath = $parser->getInitialRouting($widget . '/renderConfigurationListener', 'render.yml');

        if ($routingPath == false) {
            throw new \Exception('routing path not found in RenderConfigurationListener');
        }

        return str_replace('routing.yml', 'render.yml', $routingPath);
    }

    private function loadListeners(array $config, $file) {

        if (!array_key_exists($file, $config) || !array_key_exists('listeners', $config[$file]) || count($config[$file]['listeners']) == 0) {
            return;
        }

        $this->eventDispatcher->configListeners(array(__YML_KEY => $config[$file]));
    }

}
