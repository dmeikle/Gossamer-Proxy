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

/**
 * LoadConcatenatedFileFromCacheListener
 *
 * @author Dave Meikle
 */
class LoadConcatenatedFileFromCacheListener extends AbstractCachableListener {

    // load the key formatting
    use \core\components\compression\traits\KeyTrait;

    public function on_entry_point($event) {

    }

}
