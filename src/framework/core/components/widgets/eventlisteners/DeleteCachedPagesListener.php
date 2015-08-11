<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\widgets\eventlisteners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use Gossamer\Caching\CacheManager;


/**
 * DeleteCachedPagesListener
 *
 * @author Dave Meikle
 */
class DeleteCachedPagesListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        if(file_exists(__CACHE_DIRECTORY . 'WidgetPageTemplateConfigs')) {
            $mgr = new CacheManager();
            $mgr->deleteCache('WidgetPageTemplateConfigs');
        }
    }
}
