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

use core\components\caching\eventlisteners\AbstractCachableListener;
use Gossamer\Caching\CacheManager;
use core\eventlisteners\Event;

/**
 * Deletes cached files when they are updated in the database
 *
 * @author Dave Meikle
 */
class DeleteCachedFileListener extends AbstractCachableListener {

    /**
     * entry point
     *
     * @param Event $event
     *
     * @return void
     */
    public function on_save_success(Event $event) {

        $eventParams = $event->getParams();

        if (intval($eventParams['id']) == 0) {

            return;
        }

        $params = $this->httpRequest->getPost();
        $page = ($params['CmsPage']);

        //make sure the key passed from routing matches the one specified
        //for saving to cache also...
        $key = $this->getKey() . '-';
        if (!is_null($key)) {
            //use all requestParams to avoid name collisions on pages with
            //same name in other sections
            try {
                $permalink = $page['permalink'];
                $key = 'cms' . DIRECTORY_SEPARATOR . $key . (strlen($permalink) > 0) ? str_replace('-', '_', $permalink) : '';
            } catch (\Exception $e) {

            }
        }

        $manager = new CacheManager($this->logger);
        $manager->invalidateCache($key);
        unset($manager);
    }

}
