<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\validation\listeners;


use core\http\HTTPResponse;
use Monolog\Logger;
use core\http\HTTPRequest;
use Validation\Exceptions\ValidationFailedException;

/**
 * Description of ValidateNestedFormListener
 *
 * @author Dave Meikle
 */
class ValidateNestedAjaxFormListener extends ValidateFormListener{
    
    
    public function __construct(Logger $logger, HTTPRequest $httpRequest, HTTPResponse $httpResponse) {

        parent:: __construct($logger, $httpRequest, $httpResponse, 'Validation\\NestedValidator') ;
    }
    
    protected function validate($params = array()) {

        $result = $this->validator->validateRequest($this->httpRequest->getPost(), true);

        if(is_array($result) && count($result) > 0) {
            $this->httpRequest->setAttribute('AJAX_ERROR_RESULT', $result);
            
            throw new ValidationFailedException();  
            
        }
       
    }
}
