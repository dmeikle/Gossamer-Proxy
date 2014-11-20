<?php

namespace libraries\utils;

class UserPreferences
{
    private $params = array();

    public function set($key, $value) {
        $this->params[$key] = $value;
    }

    public function get($key) {
        if(array_key_exists($key, $this->params)) {
            return $this->params[$key];
        }

        return null;
    }

    private function init($config) {

    }
}