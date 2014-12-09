<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\http;

/**
 * Description of HTTPSession
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
