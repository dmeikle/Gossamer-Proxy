<?php


namespace components\shoppingcart;

use core\AbstractComponent;

class ShoppingCartComponent extends AbstractComponent
{
    
    
    protected function getChildNamespace() {
        return str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }
}
