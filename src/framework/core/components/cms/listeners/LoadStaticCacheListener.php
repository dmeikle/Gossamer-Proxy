<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\listeners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use exceptions\KeyNotSetException;

/**
 * loads completely rendered pages from stored HTML if they exist.
 * will then set a flag for other listeners to check and see if they
 * need to do any further actions
 *
 * @author Dave Meikle
 */
class LoadStaticCacheListener extends AbstractCachableListener {

    use \libraries\utils\traits\LoadConfigFile;

    /**
     * entry point
     *
     * @param array $params
     *
     * @return void
     */
    public function on_request_start($params) {

        $caching = $this->getCachingFromConfig();
        if (!$caching) {
            return;
        }

        $requestParams = $this->httpRequest->getParameters();
        $params['permalink'] = end($requestParams);

        $key = $this->getKey();

        if (is_null($key)) {
            return; //it wasn't set so don't try to cache the value
        } else {
            //use all requestParams to avoid name collisions on pages with
            //same name in other sections
            $key .= '-' . implode('_', $requestParams);
        }

        $locale = $this->getDefaultLocale();
        echo 'cms' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key;
        $item = $this->getValuesFromCache('cms' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key, true);
        //pr($item);
        if ($item !== false) {
            echo 'static';
            $class = $this->listenerConfig['class'];

            $this->httpRequest->setAttribute($class . '_static', $item);
        } else {
            echo 'reload';
        }
    }

    /**
     * loads configuration for cookies from the config file.
     * relies on included trait LoadConfig
     */
    private function getCachingFromConfig() {

        //load from trait
        $config = $this->loadConfig();

        if (!array_key_exists('cms', $config)) {
            throw new KeyNotSetException('cms key not found in config');
        }
        if (!array_key_exists('caching', $config['cms'])) {
            throw new KeyNotSetException('cms:caching key not found in config');
        }

        return $config['cms']['caching'] == 'true';
    }

}
