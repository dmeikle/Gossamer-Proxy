<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\listeners;

use core\eventlisteners\AbstractCachableListener;
use components\claims\models\SecondarySheetModel;

/**
 * LoadSecondarySheetQuestionsListener
 *
 * @author Dave Meikle
 */
class LoadSecondarySheetQuestionsListener extends AbstractCachableListener {

    public function on_request_start($params = array()) {

        $datasource = $this->getDatasource('components\\claims\\models\\SecondarySheetModel');
        $model = new SecondarySheetModel($this->httpRequest, $this->httpResponse, $this->logger);

        $locale = $this->getDefaultLocale();

        $params = array('directive::OFFSET' => '0', 'directive::LIMIT' => '200', 'locale' => $locale['locale']);

        $result = $datasource->query('get', $model, 'listquestions', $params);

        if (array_key_exists('Actions', $result)) {
            $this->httpRequest->setAttribute($this->getResponseKey(), $result['Actions']);
            $this->saveValuesToCache($this->getKey(), $result['Actions']);
        } else {
            $this->httpRequest->setAttribute($this->getResponseKey(), array());
        }
    }

    /**
     * can be overridden for custom keys
     *
     * @return string
     */
    protected function getKey($params = null) {
        $locale = $this->getDefaultLocale();

        if (array_key_exists('cacheKey', $this->listenerConfig)) {
            return $this->listenerConfig['cacheKey'] . '_' . $locale['locale'];
        }

        return null;
    }

}
