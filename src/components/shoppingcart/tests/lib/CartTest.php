<?php

namespace components\shoppingcart\tests\lib;

use components\shoppingcart\lib\Cart;
use core\datasources\DatasourceFactory;
use components\shoppingcart\tests\BaseTest;

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
