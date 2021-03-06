<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\compression\listeners;

use core\components\caching\eventlisteners\AbstractCachableListener;
use core\eventlisteners\Event;

/**
 * SaveConcatenatedFileToCacheListener
 *
 * @author Dave Meikle
 */
class SaveConcatenatedFileToCacheListener extends AbstractCachableListener {

    use \core\components\compression\traits\KeyTrait;

    public function on_render_complete(Event $event) {
        $params = $event->getParams();
        $fileList = $this->httpRequest->getQueryParameter('files');
        $this->saveValuesToCache($this->getKey(), $params['contents'], true);
    }

}
