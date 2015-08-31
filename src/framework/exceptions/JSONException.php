<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace exceptions;

/**
 * JSONException
 *
 * @author Dave Meikle
 */
class JSONException extends \Exception {
    
    public function __construct($message, $code, $previous = null) {
        $retval = array('success' => 'false', 'message' => $message);
        
        parent::__construct(json_encode($retval), $code, $previous);
    }
}
