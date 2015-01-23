<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\locales\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\locales\models\LocaleModel;

/**
 * loads the locales list from the database so we know what we're working 
 * with as far as language choices go. To avoid redundant requests to the 
 * server, it caches this info locally
 * 
 * @author Dave Meikle
 */
class LoadLocalesListener extends AbstractCachableListener {

    /**
     * entry point
     * 
     * @param string $filename
     */
    public function on_request_start($filename) {
        
        $retval = array();
        $model = new LocaleModel($this->httpRequest, $this->httpResponse, $this->logger);

        $params = array();
        $caching = true;
        $datasource = $this->getDatasource(get_class($model));
        
        try {
            //query the database for the list of locales
            $result = $datasource->query('get', $model, 'list', $params);

            if (is_array($result) && count($result) > 0) {
                $locales = current($result);

                foreach ($locales as $locale) {
                    $retval[$locale['locale']] = $locale;
                }

                //put the list into the request object so everyone can enjoy
                $this->httpRequest->setAttribute('locales', $retval);
            }
        } catch (\Exception $e) {
            
        }
        unset($model);

        //now to cache the values
        //note: make sure the cacheKey in routing matches they returned key from REST call - Title cased is automatic
        $key = $this->getKey();

        if (is_array($retval) && count($retval) > 0) {

            if (is_null($key)) {

                $key = key($retval);
                $caching = false; //it wasn't set so don't try to cache the value
            }

            //save the list to cache for future requests
            if ($caching && count($retval) > 0) {
                $this->saveValuesToCache($key, $retval);
            }
        }
    }

}
