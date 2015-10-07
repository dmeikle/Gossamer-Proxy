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

use core\eventlisteners\AbstractCachableListener;

/**
 * LoadCachedPageListener
 *
 * @author Dave Meikle
 */
class LoadCachedPageListener extends AbstractCachableListener {

    public function on_request_start($params) {
        $config = $this->httpRequest->getAttribute('RENDER_CONFIG');

        $path = __SITE_PATH . DIRECTORY_SEPARATOR . $config['path'];
        if (!file_exists($path)) {
            throw new \Exception($path . ' is not a valid file to render in RenderHTMLView');
        }
        $this->httpRequest->setAttribute('test', file_get_contents($path));
        $this->httpRequest->setAttribute($this->getKey(), file_get_contents($path));
    }

    protected function getKey($params = null) {
        list($widget, $file) = $this->httpRequest->getParameters();
        $locale = $this->getDefaultLocale();
        $key = DIRECTORY_SEPARATOR . 'render' . DIRECTORY_SEPARATOR . $widget . DIRECTORY_SEPARATOR . $file . '_' . $locale['locale'];

        return $key;
    }

}
