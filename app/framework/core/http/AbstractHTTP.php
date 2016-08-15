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
 * abstract base class
 *
 * @author Dave Meikle
 */
class AbstractHTTP {

    protected $logger = null;
    protected $headers = null;
    protected $contentType = 'application/json';
    protected $method = null;
    protected $attributes = array();

    public function __destruct() {
        while (count($this->attributes) > 0) {
            try {
                $item = array_pop($this->attributes);
                super_unset($item);
            } catch (\Exception $e) {

            }
        }
    }

    /**
     * accessor
     *
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * accessor
     *
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

}
