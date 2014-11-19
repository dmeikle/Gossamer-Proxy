<?php

namespace components\validation\listeners;


use core\http\HTTPResponse;
use Monolog\Logger;
use core\http\HTTPRequest;

/**
 * Description of ValidateNestedFormListener
 *
 * @author davem
 */
class ValidateNestedFormListener extends ValidateFormListener{
    
    
    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {
        parent:: __construct($logger, $httpRequest, $httpResponse, 'Validation\\NestedValidator') ;
    }
    
}
