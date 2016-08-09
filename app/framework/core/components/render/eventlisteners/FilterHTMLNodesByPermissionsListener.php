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

use core\components\security\eventlisteners\FilterHTMLNodesByPermissionsListener as BaseListener;

/**
 * FilterHTMLNodesByPermissionsListener
 *
 * @author Dave Meikle
 */
class FilterHTMLNodesByPermissionsListener extends BaseListener {

    protected function loadPermissionsConfig() {
        $ymlKey = $this->getOverrideYmlKey();

        $config = $this->loadCachedComponentConfig($ymlKey, 'permissions_config', 'permissions');

        if (array_key_exists($ymlKey, $config)) {
            return $config[$ymlKey];
        } else {
            return null;
        }
    }

    private function getOverrideYmlKey() {
        list($widget, $ymlKey) = $this->httpRequest->getParameters();

        return $ymlKey;
    }

}
