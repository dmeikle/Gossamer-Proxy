<?php

namespace components\shoppingcart\tests;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    
    
    protected function getLogger() {
        
            $logger = new Logger('phpUnitTest');
            $logger->pushHandler(new StreamHandler("../logs/phpunit.log", Logger::DEBUG));  
       
        
        return $logger;
    }
}
