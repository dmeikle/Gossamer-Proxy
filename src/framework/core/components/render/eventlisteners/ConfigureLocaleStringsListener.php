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

use core\eventlisteners\AbstractListener;

/**
 * ConfigureLocaleStringsListener
 *
 * this is a prep file for using the framework's LoadLocaleStringsListener.
 * Since the framework uses langFiles as a key for independent configuration
 * then combines all langFiles into a langFilesList we need to 'bootstrap' the
 * langFiles into 1 basic array before passing it through to the LoadLocaleStringsListener.
 * 
 * @author Dave Meikle
 */
class ConfigureLocaleStringsListener extends AbstractListener {
    
    public function on_request_start() {
        $config = $this->httpRequest->getAttribute('RENDER_CONFIG');
        
        if(!is_array($config)) {
            throw \Exception('RENDER_CONFIG not located in HTTPRequest');
        }
        
        if(array_key_exists('langFiles', $config)) {
            $this->httpRequest->setAttribute('langFilesList', $config['langFiles']);
        }
    }
}
