<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use exceptions\KeyNotSetException;
use Gossamer\Caching\CacheManager;

/**
 * abstract listener for Event Listeners that want to cache results and
 * load them later
 *
 * @author Dave Meikle
 */
class AbstractCachableListener extends AbstractListener {

    const MAX_FILE_LIFESPAN = 20000; //20 minutes

    //this value MUST be assigned by child class

    protected $key = null;

    /**
     * 
     * @param string $state
     * @param type $params
     * 
     * @return void
     */
    public function execute($state, &$params) {

        $method = 'on_' . $state;

        $this->logger->addDebug('checking cachablelistener for method: ' . $method);
        if (method_exists($this, $method)) {
            //first check cache
            $key = $this->getKey();

            $values = '';

            if (!is_null($key)) {
                $values = $this->getValuesFromCache($key);
            }

            if (is_null($key) || $values === false) {

                $this->logger->addDebug('class: ' . get_class($this) . ' found');
                call_user_func_array(array($this, $method), array($params));

                return;
            }
            //pass it along the request in case there's more processing to do
            $this->httpRequest->setAttribute(self::getKey(), $values);

            //add it to the response in case it's an abstract parent calling
            //this from configuration files and is simply needed in the view
            $this->httpResponse->setAttribute(self::getKey(), $values);
        }
    }

    /**
     * can be overridden for custom keys
     * 
     * @return string
     */
    protected function getKey() {
        if (array_key_exists('cacheKey', $this->listenerConfig)) {
            return $this->listenerConfig['cacheKey'];
        }

        return null;
    }

    /**
     * save the values into cache
     * 
     * @param type $key
     * @param type $values
     * @param type $static
     * 
     * @return boolean
     */
    protected function saveValuesToCache($key, $values, $static = false) {
        $manager = new CacheManager($this->logger);

        return $manager->saveToCache($key, $values, $static);
    }

    /**
     * retrieve values stored in cache
     * 
     * @param type $key
     * @param type $static
     * @return array|string
     */
    protected function getValuesFromCache($key, $static = false) {

        $manager = new CacheManager($this->logger);

        return $manager->retrieveFromCache($key, $static);
    }

}
