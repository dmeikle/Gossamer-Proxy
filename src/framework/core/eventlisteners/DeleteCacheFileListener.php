<?php

namespace core\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;

/**
 * Description of DeleteFileListener
 *
 * @author davem
 */
class DeleteCacheFileListener extends AbstractListener {
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
       
        $manager = new CacheManager($this->logger);
        //the convention in yml is to use the entity name with an 's' appended
        $manager->invalidateCache($params['entity'] . 's');
        
        unset($manager);
    }
}
