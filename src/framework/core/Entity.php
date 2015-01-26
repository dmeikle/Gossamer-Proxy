<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core;

/**
 *
 * @author Dave Meikle
 */
class Entity {
   
    private $entity = null;
    
    public function populate($key, array $values = array()) {
        if(array_key_exists($key, $values)) {
            $this->entity = current($values[$key]);
        }
    }
    
    public function getArray() {
        return $this->entity;
    }
    
    public function __get($name) {
        if(array_key_exists($name, $this->entity)) {
            return $this->entity[$name];
        }
    }
    
    public function __set($name, $value) {
        $this->entity[$name] = $value;
    }
    
    public function __unset($name) {
        unset($this->entity[$name]);
    }
    
    public function __isset($name) {
        return isset($this->entity[$name]);
    }
}
