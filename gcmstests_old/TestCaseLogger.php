<?php
namespace tests;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestCaseLogger
 *
 * @author Dave Meikle
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class TestCaseLogger  extends \PHPUnit_Framework_TestCase{
    
    protected $logger = null;
    
   public function __construct() {
        $logger = new Logger('rest_service');
        $logger->pushHandler(new StreamHandler( __SITE_PATH . "/../logs/monolog.log", Logger::DEBUG));

   }
}
