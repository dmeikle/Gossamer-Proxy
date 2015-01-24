<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;

/**
 * used to delete a cache file if the administrator has edited a page that 
 * is cached
 *
 * @author Dave Meikle
 */
class DeleteCacheFileListener extends AbstractListener {

    /**
     * 
     * @param Event $event
     */
    public function on_save_success(Event $event) {
        $params = $event->getParams();

        $manager = new CacheManager($this->logger);
        //the convention in yml is to use the entity name with an 's' appended
        $manager->invalidateCache($params['entity'] . 's');

        unset($manager);
    }

}
