<?php
namespace libraries\utils;

/**
 * Registry Class - The magic bag that holds all of our results and parameters
 *                - to be passed throughout the system
 *
 * Author: Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class Registry
{

    /**
     * array of all values to hold
     */
    private $list = null;

    /**
     * constructor
     *
     * @param array|null
     */
    public function __construct($params = array()) {
        if(count($params) > 0) {
            $this->list = array();
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * set - overridable function
     *
     * @param variant
     */
    public function __set($key, $value){
        if(is_null($this->list)){
            $this->list = array();
        }
        $this->list[$key] = $value;
    }

    /**
     * get - overridable function
     *
     * @return variant
     */
    public function __get($key){
        if(!is_array($this->list) || !array_key_exists($key, $this->list)){
            return null;
        }

        return $this->list[$key];
    }

    /**
     * toArray - returns the list in 1 shot
     *
     * @return array
     */
    public function toArray() {
        return $this->list;
    }
}
