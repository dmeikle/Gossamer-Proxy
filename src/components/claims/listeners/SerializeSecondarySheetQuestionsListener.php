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
use components\claims\serialization\SecondarySheetSerializer;

/**
 * SerializeSecondarySheetQuestionsListener
 *
 * @author Dave Meikle
 */
class SerializeSecondarySheetQuestionsListener extends AbstractCachableListener {

    public function on_request_start($params = array()) {

        $questions = $this->httpRequest->getAttribute($this->getDependencyKey());
        pr($questions);
        die;
        $serializer = new SecondarySheetSerializer();
        $result[$this->getDependencyKey()] = $serializer->serializeQuestions(array('Actions' => $questions));

        $this->saveValuesToCache($this->getKey(), $result);
        $this->httpRequest->setAttribute($this->getResponseKey(), $result);
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

    private function getDependencyKey() {
        return $this->listenerConfig['dependency'];
    }

}
