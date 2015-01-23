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

use core\eventlisteners\AbstractCachableListener;

/**
 * loads completely rendered pages from stored HTML if they exist.
 * will then set a flag for other listeners to check and see if they
 * need to do any further actions
 *
 * @author Dave Meikle
 */
class LoadStaticCacheListener extends AbstractCachableListener {

    /**
     * entry point
     * 
     * @param array $params
     * 
     * @return void
     */
    public function on_request_start($params) {


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

        $item = $this->getValuesFromCache('cms' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key, true);

        if ($item !== false) {
            $class = $this->listenerConfig['class'];

            $this->httpRequest->setAttribute($class . '_static', $item);
        }
    }

}
