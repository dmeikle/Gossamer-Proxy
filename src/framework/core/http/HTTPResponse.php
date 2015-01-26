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
 * the HTTPRespoone object we will pass around to pass data direct to the view
 * 
 * @author Dave Meikle
 */
class HTTPResponse {

    private $attributes = null;
    private $version;
    private $statusCode;
    private $statusText;
    private $headers;
    private $content;

    public function __construct($content = null) {
        $this->content = $content;
    }

    /**
     * accessor
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key, $value) {
        $attributes = $this->getAttributes();

        $attributes[$key] = $value;

        $this->attributes = $attributes;
    }

    /**
     * accessor
     * 
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key) {
        if (array_key_exists($key, $this->getAttributes())) {
            $attributes = $this->getAttribute();
            return $attributes[$key];
        }

        return null;
    }

    /**
     * accessor
     * 
     * @return mixed
     */
    public function getAttributes() {
        if (is_null($this->attributes)) {
            $this->attributes = array();
        }

        return $this->attributes;
    }

    /**
     * Returns the Response as an HTTP string.
     *
     * The string representation of the Response is the same as the
     * one that will be sent to the client only if the prepare() method
     * has been called before.
     *
     * @return string The Response as an HTTP string
     *
     * @see prepare()
     */
    public function __toString() {
        return
                sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText) . "\r\n" .
                $this->headers . "\r\n" .
                $this->getContent();
    }

    public function getContent() {
        return $this->content;
    }

}
