<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\angular\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * DrawURILinksListener
 *
 * @author Dave Meikle
 */
class DrawURILinksListener extends AbstractListener {

    public function on_filerender_end(Event &$params) {
        pr($params);
    }

}
