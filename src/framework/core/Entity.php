<?php


namespace core;

/**
 * Description of Entity
 *
 * @author davem
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
