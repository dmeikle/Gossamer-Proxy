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

use Monolog\Logger;

class AbstractHTTP
{
    protected $logger = null;
    
    protected $headers = null;
    
    protected $contentType = 'application/json';
    
    protected $method = null;
    
    protected $attributes = array();
    
   
    public function getAttributes() {
        return $this->attributes;
    }
    
    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }
    
    
}
