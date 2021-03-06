<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\behaviors\listeners;

use core\eventlisteners\AbstractListener;
use libraries\utils\YAMLParser;

/**
 * LoadBehaviorsListener
 *
 * CP-175 create a method for loading behaviors on a request outside of
 * the routing file to reduce routing to basic config only. This avoids
 * the excessive file lengths that occur when using multiform loader and
 * dependencies in the routing file
 *
 * @author Dave Meikle
 */
class LoadBehaviorsListener extends AbstractListener {

    public function on_entry_point($params) {

        $nodeConfig = $this->httpRequest->getNodeConfig();
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $nodeConfig['namespace']) . DIRECTORY_SEPARATOR . $nodeConfig['componentFolder'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'listeners.yml';

        $config = $this->loadBehaviorConfig(__SITE_PATH . DIRECTORY_SEPARATOR . $path, __YML_KEY);

        if (!is_null($config)) {
            $nodeConfig['listeners'] = $config;
            $this->httpRequest->setNodeConfig($nodeConfig);

            //add the new config to the dispatcher
            $this->eventDispatcher->configNodeListeners(__YML_KEY, $nodeConfig);
        }
    }

    public function on_filerender_entry_point($params) {

        list($component, $ymlKey) = $this->httpRequest->getParameters();
        $path = 'src/components' . DIRECTORY_SEPARATOR . $component . DIRECTORY_SEPARATOR;
        //we need this for any include files in the view
        $this->httpResponse->setAttribute('componentFolder', $path);
        $path .= 'config' . DIRECTORY_SEPARATOR . 'listeners.yml';

        $config = $this->loadBehaviorConfig(__SITE_PATH . DIRECTORY_SEPARATOR . $path, $ymlKey);

        if (!is_null($config)) {

            $nodeConfig['listeners'] = $config;
            $this->httpRequest->setNodeConfig($nodeConfig);

            //add the new config to the dispatcher
            $this->eventDispatcher->configNodeListeners($ymlKey, $nodeConfig);
        }
    }

    /**
     * loadBehaviorConfig - loads the listeners from the optional listeners.yml file
     *
     * @param type $widget
     * @return type
     *
     * @throws \Exception
     */
    private function loadBehaviorConfig($path, $ymlKey) {
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath($path);

        $config = $parser->loadConfig();
//        pr($config);
        if (!is_null($config) && $config !== false && array_key_exists($ymlKey, $config) && array_key_exists('listeners', $config[$ymlKey])) {
            return $config[$ymlKey]['listeners'];
        }

        return null;
    }

}
