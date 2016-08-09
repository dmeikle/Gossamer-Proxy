<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\http;

/**
 * sent out when we have an error. Sets the headers for our response automagically
 * 
 * @author Dave Meikle
 */
class ErrorResponse extends AbstractHTTP {

    private $errorCode = null;
    private $errorMessage = null;

    /**
     * 
     * @return header
     */
    public function getResponseHeader() {
        return header("HTTP/1.1 " . $result['code'] . " " . $result['message']);
    }

}
