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
 * HTTPSession - not yet implemented
 *
 * @author user
 */
class HTTPSession {

    public function get($key) {
        $session = $_SESSION;

        return $session[$key];
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

}
