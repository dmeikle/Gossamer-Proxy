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

/**
 * loads a list of items that might be needed by another resource
 *
 * @author Dave Meikle
 */
class LoadListListener extends AbstractCachableListener {

    /**
     * while this loads the list into httprequest, you still need to retrieve it from the request
     * into the data array if needed in the view (I'm refering to 'inside the controller').
     * That means the controller needs to say $list = $this->httpRequest->getAttribute('name-of-key-from-yml');
     *
     * this gets called only if it fails the cached values check, so you won't see
     * any 'get from cache' in this method
     */
    protected function loadList() {

        $caching = true;

        $class = $this->listenerConfig['class'];
        $params = (array_key_exists('params', $this->listenerConfig) ? $this->listenerConfig['params'] : array());

        $defaultLocale = $this->getDefaultLocale();
        if (!array_key_exists('locale', $params)) {
            $params['locale'] = $defaultLocale['locale'];
        }

        $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($class);

        $result = $datasource->query('get', $model, $this->getVerb(), $params);
        $list = array();

        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = $this->getKey();

        if (!is_null($result) && is_array($result)) {

            if (is_null($key)) {

                $key = key($result);
                $caching = false; //it wasn't set so don't try to cache the value
            }

            $list = $result[$key];
        }

        //set it here in case we want to use it still before sending to response
        $this->httpRequest->setAttribute($key, $list);

        //send it here in case it's being called in an abstract parent and won't
        //be seen until the response is rendered
        $this->httpResponse->setAttribute($key, $list);

        if ($caching && count($list) > 0) {
            $this->saveValuesToCache($key, $list);
        }
    }

    public function on_request_start($params) {
        $this->loadList();
    }

    public function on_request_end($params) {
        $this->loadList();
    }

    public function on_response_start($params) {
        $this->loadList();
    }

    public function on_response_end($params) {
        $this->loadList();
    }

    public function on_filerender_start($params) {
        $this->loadList();
    }

    protected function getVerb() {

        if (array_key_exists('verb', $this->listenerConfig)) {
            return $this->listenerConfig['verb'];
        }
        if (array_key_exists('customVerb', $this->listenerConfig)) {
            return $this->listenerConfig['customVerb'];
        }

        return 'list';
    }

}
