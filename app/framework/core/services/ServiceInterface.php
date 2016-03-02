<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\services;

use libraries\utils\Container;

/**
 * ServiceInterface
 *
 * @author Dave Meikle
 */
interface ServiceInterface {

    public function setContainer(Container $container);

    public function setParameters(array $params);

    public function execute();
}
