<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

/** *
 * Author: dave
 * Date: 9/20/2016
 * Time: 10:12 AM
 */

namespace libraries\utils\traits;


use libraries\utils\Container;

trait ContainerAccessorsTrait
{
    protected $container;

    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function getContainer() {
        return $this->container;
    }
}