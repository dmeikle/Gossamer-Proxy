<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\tests\lib;

use components\shoppingcart\lib\Cart;
use core\datasources\DatasourceFactory;
use tests\BaseTest;

class CartTest extends BaseTest
{
    private $cart = null;
    
    protected function setUp() {
        $factory = new DatasourceFactory();
        $ds = $factory->getDatasource('datasource1', $this->getLogger());
        
        $this->cart = new Cart($ds);    
    }
    
    public function testAddProduct() {
        
    }
}
