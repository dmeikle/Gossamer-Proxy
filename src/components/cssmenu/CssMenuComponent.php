<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\cssmenu;

use core\AbstractComponent;

/**
 * CssMenuComponent
 *
 * @author Dave Meikle
 */
class CssMenuComponent extends AbstractComponent {

    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }

}
