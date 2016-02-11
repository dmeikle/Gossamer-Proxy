<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\eventlisteners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;

/**
 * SaveCachedPageListener
 *
 * @author Dave Meikle
 */
class SaveCachedPageListener extends AbstractCachableListener {

    public function on_render_complete(Event $event) {
        if (!array_key_exists('cacheKey', $this->listenerConfig)) {
            return;
        }
        $params = $event->getParams();
        $this->saveValuesToCache($this->getKey(), $params['renderedPage'], true);
    }

    protected function getKey($params = null) {
        list($widget, $file) = $this->httpRequest->getParameters();
        $locale = $this->getDefaultLocale();
        $key = DIRECTORY_SEPARATOR . 'render' . DIRECTORY_SEPARATOR . $widget . DIRECTORY_SEPARATOR . $file . '_' . $locale['locale'];

        return $key;
    }

}
