<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils;

use Monolog\Logger;

/**
 * converts UTF8 values to regular strings
 *
 * @author  Dave Meikle
 * 
 * @date    August 11, 2014
 */
class UnicodeHandler {

    private $config = null;

    /**
     * 
     * @param Logger $logger
     * @param array $configuration
     */
    public function __construct(Logger $logger, $configuration) {
        if (is_array($configuration) && array_key_exists(__YML_KEY, $configuration)) {
            $this->config = $configuration[__YML_KEY];
        }
    }

    /**
     * 
     * @param type $string
     * 
     * @return boolean
     */
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * 
     * @param type $object
     * 
     * @return array
     */
    private function convertObjectToArray($object) {
        $retval = array();
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        foreach ($object as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $retval[$key] = $this->convertObjectToArray($value);
            } else {
                $retval[$key] = $value;
            }
        }

        return $retval;
    }

    /**
     * 
     * @param mixed $parameters
     * 
     * @return array
     */
    public function formatToAsciiAfterReceiving($parameters) {

        //first decouple it from array of objects into an array of arrays
        $array = $this->decoupleToArray($parameters);

        return $this->convertArrayText($array);
    }

    /**
     * 
     * @param mixed $parameters
     * 
     * @return array
     */
    private function decoupleToArray($parameters) {

        if (is_object($parameters)) {
            $parameters = get_object_vars($parameters);
        }

        return is_array($parameters) ? array_map(__METHOD__, $parameters) : $parameters;
    }

    /**
     * 
     * @param array $parameters
     * 
     * @return array
     */
    private function convertArrayText($parameters = null) {
        if (is_null($parameters)) {
            return $parameters;
        }
        $retval = array();


        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $retval[$key] = $this->convertArrayText($value);
            } else {
                $retval[$key] = $this->hex2ascii($key, $value);
            }
        }

        return $retval;
    }

    /**
     * 
     * @param array $parameters
     * 
     * @return array
     */
    public function decode($parameters) {

        $result = $this->formatToAsciiAfterReceiving($parameters);

        return $result;
    }

    /**
     * 
     * @param array $parameters
     * 
     * @return array
     */
    public function encode($parameters) {

        return $this->formatToHexForSending($parameters);
    }

    /**
     * 
     * @param array $parameters
     * 
     * @return array
     */
    private function formatToHexForSending($parameters) {
        $retval = array();
        if (!is_array($parameters)) {

            return $this->ascii2hex($parameters);
        }
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $retval[$key] = $this->formatToHexForSending($value);
            } else {
                $retval[$key] = $this->ascii2hex($key, $value);
            }
        }

        return $retval;
    }

    /**
     * 
     * @param string $key
     * @param string $ascii
     * 
     * @return string
     */
    private function ascii2hex($key, $ascii) {

        if (is_null($this->config) || (!is_null($this->config) && !array_key_exists($key, $this->config))) {

            return $ascii; //don't bother to convert it - it's not on our list
        }

        $hex = '0x';
        for ($i = 0; $i < strlen($ascii); $i++) {
            $byte = strtoupper(dechex(ord($ascii{$i})));
            $byte = str_repeat('0', 2 - strlen($byte)) . $byte;
            $hex.=$byte . " ";
        }

        return $hex;
    }

    /**
     * 
     * @param string $key
     * @param string $hex
     * 
     * @return string
     */
    private function hex2ascii($key, $hex) {

        if (is_null($this->config) || (!is_null($this->config) && !array_key_exists($key, $this->config))) {
            return $hex; //don't bother to convert it - it's not on our list
        }

        if (is_object($hex) || substr($hex, 0, 2) !== '0x') {

            return $hex;
        }

        $ascii = '';

        $hex = str_replace(" ", "", substr($hex, 2));
        for ($i = 0; $i < strlen($hex); $i = $i + 2) {
            $ascii.=chr(hexdec(substr($hex, $i, 2)));
        }

        return($ascii);
    }

}
