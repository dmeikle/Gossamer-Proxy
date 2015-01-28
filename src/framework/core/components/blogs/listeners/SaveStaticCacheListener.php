<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\blogs\listeners;

use core\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;

/**
 * Description of SaveStaticCacheListener
 *
 * @author Dave Meikle
 */
class SaveStaticCacheListener extends AbstractCachableListener{
    
    public function on_response_start(Event $event) {
      
        ob_start(); // start the output buffer

    }
    
    public function on_render_complete(Event $event) {
       
        $requestParams = $this->httpRequest->getParameters();       
        $params['permalink'] = end($requestParams);
        
        $key = $this->getKey();
        $locale = $this->getDefaultLocale();
        
        if(!is_null($key)) {
            $key .= '-' . implode('_', $requestParams); 
            $manager = new CacheManager($this->logger);
            $manager->saveToCache('blogs' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . $locale['locale'] . DIRECTORY_SEPARATOR . $key , ob_get_contents(), true);
            unset($manager);
        }
        ob_end_flush();
    }
}
