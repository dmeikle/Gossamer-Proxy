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
use core\components\caching\eventlisteners\AbstractCachableListener;

use core\components\caching\eventlisteners\AbstractCachableListener;

/**
 * loads a single item that may be needed by another method.
 *
 * @author Dave Meikle
 */
class LoadItemListener extends AbstractCachableListener {

    /**
     * load the item. could be from the DB or from Cache
     */
    protected function loadItem() {

        $caching = true;

        $class = $this->listenerConfig['class'];
        //$params = (array_key_exists('params', $this->listenerConfig)? $this->listenerConfig['params'] : array());
        $params = $this->getParameters();

        $model = new $class($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($class);

        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = $this->getKey();
        if (is_null($key)) {
            $caching = false; //it wasn't set so don't try to cache the value
        }

        $result = $datasource->query('get', $model, 'get', $params);
        $item = array();
        if (!is_null($result) && is_array($result)) {
            $item = current($result[$model->getEntity()]);
        }

        //set it here in case we want to use it still before sending to response
        $this->httpRequest->setAttribute($class, $item);

        //send it here in case it's being called in an abstract parent and won't
        //be seen until the response is rendered
        $this->httpResponse->setAttribute($class, $item);

        if ($caching && !is_null($item) > 0) {
            $this->saveValuesToCache($key, $item);
        }
    }

    /**
     * gets the parameters either from the uri or from yml
     *
     * @return array
     */
    protected function getParameters() {
        $configParams = (array_key_exists('params', $this->listenerConfig) ? $this->listenerConfig['params'] : array());

        if (array_key_exists('type', $configParams)) {
            if ($configParams['type'] == 'uri') {
                return $this->httpRequest->getParameters();
            }
            if ($configParams['type'] == 'query') {
                return $this->httpRequest->getQueryParameters();
            }
        }

        return $configParams;
    }

    /**
     *
     * @param mixed $params
     */
    public function on_request_start($params) {
        $this->loadItem();
    }

    /**
     *
     * @param mixed $params
     */
    public function on_request_end($params) {
        $this->loadItem();
    }

    /**
     *
     * @param mixed $params
     */
    public function on_response_start($params) {
        $this->loadItem();
    }

    /**
     *
     * @param mixed $params
     */
    public function on_response_end($params) {
        $this->loadItem();
    }

    /**
     *
     * @param mixed $params
     */
    public function on_entry_point($params) {
        $this->loadItem();
    }

    /**
     *
     * @param mixed $params
     */
    public function on_filerender_start($params) {
        $this->loadItem();
    }

}
