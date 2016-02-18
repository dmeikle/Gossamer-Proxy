<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\caching\eventlisteners;

use exceptions\KeyNotSetException;
use Gossamer\Caching\CacheManager;
use core\eventlisteners\AbstractListener;

/**
 * abstract listener for Event Listeners that want to cache results and
 * load them later
 *
 * @author Dave Meikle
 */
class AbstractCachableListener extends AbstractListener {

    const MAX_FILE_LIFESPAN = 12000; //20 minutes

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
            $key = $this->getKey($params);

            $this->checkEtag($key);

            $values = '';

            if (!is_null($key)) {

                $values = $this->getValuesFromCache($key, $this->getIsStaticCache());
            }

            if (is_null($key) || $values === false) {

                $this->logger->addDebug('class: ' . get_class($this) . ' found');
                call_user_func_array(array($this, $method), array($params));

                $this->setEtag($key);

                return;
            }

            $this->setEtag($key);
            //pass it along the request in case there's more processing to do
            // $this->httpRequest->setAttribute(self::getKey(), $values);
            //changed to '$key' because it was losing values in some instances with '/' in the key
            $this->httpRequest->setAttribute($this->getResponseKey(), $values);

            if (!array_key_exists('addToResponse', $this->listenerConfig) || $this->listenerConfig['addToResponse'] == 'true') {
                //add it to the response in case it's an abstract parent calling
                //this from configuration files and is simply needed in the view
                // $this->httpResponse->setAttribute(self::getKey(), $values);
                //changed to '$key' because it was losing values in some instances with '/' in the key
                $this->httpResponse->setAttribute($this->getResponseKey(), $values);
            }
        }
    }

    protected function getResponseKey() {

        if (array_key_exists('responseKey', $this->listenerConfig)) {
            return $this->listenerConfig['responseKey'];
        }

        return $this->getKey();
    }

    protected function getIsStaticCache() {

        if (array_key_exists('static', $this->listenerConfig)) {
            return $this->listenerConfig['static'] == 'true';
        }

        return false;
    }

    /**
     * can be overridden for custom keys
     *
     * @return string
     */
    protected function getKey($params = null) {
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
    protected function deleteCache($key) {
        $manager = new CacheManager($this->logger);

        return $manager->deleteCache($key);
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
    protected function getValuesFromCache($key, $static) {

        $manager = new CacheManager($this->logger);

        return $manager->retrieveFromCache($key, $static);
    }

    protected function getAgentTypesAsKeyString() {

        return implode('_', $this->getLayoutType());
    }

    protected function checkEtag($key) {

        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) &&
                stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) == '"' . $this->getEtag($key) . '"') {
            // Return visit and no modifications, so do not send anything
            header("HTTP/1.0 304 Not Modified");
            header('Content-Length: 0');
            exit;
        }
    }

    protected function setEtag($key) {
        header("Etag: \"" . $this->getEtag($key) . "\"");
    }

    protected function getEtag($key) {
        $date = getdate();

        return $date['month'] . $date['mday'] . $date['year'] . '-' . md5($key) . "\"";
    }

}
