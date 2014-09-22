<?php


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
    
        
    public function __construct(Logger $logger,  $configuration) {
      if(is_array($configuration) && array_key_exists(__YML_KEY, $configuration)) {
         $this->config = $configuration[__YML_KEY];
       
      }        
    }
    
    
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    
    private function convertObjectToArray($object) {
        $retval = array();
        if(!is_object($object) && !is_array($object)) {
            return $object;
        }
        if(is_object($object)) {
            $object = get_object_vars($object);
        }
        foreach($object as $key => $value) {
            if(is_object($value) || is_array($value)) {
                $retval[$key] = $this->convertObjectToArray($value);
            } else {
                $retval[$key] = $value;
            }
        }
        
        return $retval;
    }
    
    
    public function formatToAsciiAfterReceiving($parameters) {
       
        //first decouple it from array of objects into an array of arrays
        $array = $this->decoupleToArray($parameters);
       
       // file_put_contents('/var/www/shoppingcart/logs/test3.log', "decoupleToArray is now " . print_r($array, true) . "\r\n", FILE_APPEND);
       // $array = $this->convertJsonToArrays($array);
        
       // file_put_contents('/var/www/shoppingcart/logs/test3.log', "convertJsonToArray is now " . print_r($array, true) . "\r\n", FILE_APPEND);
        return $this->convertArrayText($array);
    }
    
    private function decoupleToArray($parameters) {
        
        if(is_object($parameters)) {
            $parameters = get_object_vars($parameters);
        }

        return is_array($parameters) ? array_map(__METHOD__, $parameters) : $parameters;
    }

    private function convertJsonToArrays($parameters) {
        $retval = array();
        if(!is_array($parameters)) {
            return $parameters;
        }
        foreach($parameters as $key => $value) {
            if($this->isJson($value)) {
               // file_put_contents('/var/www/shoppingcart/logs/test3.log', "$key isjson $value\r\n", FILE_APPEND);
                $value = json_decode($value);
              //  file_put_contents('/var/www/shoppingcart/logs/test3.log', "$key json_decoded " . print_r($value, true) . "\r\n", FILE_APPEND);
        
                $value = $this->decoupleToArray($value);
             //   file_put_contents('/var/www/shoppingcart/logs/test3.log', "$key object decoupledtoarray is now  " . print_r($value, true) . "\r\n", FILE_APPEND);
        
                //$value = $this->convertJsonToArrays($value);
            }
            $retval[$key] = $value;
        }
        
        return $retval;
    }
    private function convertArrayText($parameters = null) {
        if(is_null($parameters)) {
            return $parameters;
        }
        $retval = array();
      
     
        foreach($parameters as $key => $value) {
           if(is_array($value)) {
                $retval[$key] = $this->convertArrayText($value);
            }else {
                $retval[$key] = $this->hex2ascii($key, $value);

            }
        }

        return $retval;
    }
    
    public function decode($parameters) {
        
        $result = $this->formatToAsciiAfterReceiving($parameters);
     
        return $result;
    }
    
    public function encode($parameters) {
      
        return $this->formatToHexForSending($parameters);
    }
    
    private function formatToHexForSending($parameters) {
        $retval = array();
        if(!is_array($parameters)){
           
            return $this->ascii2hex($parameters);
        }
        foreach($parameters as $key => $value) {
            if(is_array($value)) {
                $retval[$key] = $this->formatToHexForSending($value);
            
            } else {
                $retval[$key] = $this->ascii2hex($key, $value);
            }
        }
    
        return $retval;
    }
    
    private function ascii2hex($key, $ascii) {
       
        if(is_null($this->config) || (!is_null($this->config) && !array_key_exists($key, $this->config))) {
          
            return $ascii;//don't bother to convert it - it's not on our list
        }
     
        $hex = '0x';
        for ($i = 0; $i < strlen($ascii); $i++) {
            $byte = strtoupper(dechex(ord($ascii{$i})));
            $byte = str_repeat('0', 2 - strlen($byte)).$byte;
            $hex.=$byte." ";
        }
    
        return $hex;
    }
    
    private function hex2ascii($key, $hex){
        
        if(is_null($this->config) || (!is_null($this->config) && !array_key_exists($key, $this->config))) {
           return $hex;//don't bother to convert it - it's not on our list
        }
       
        if(is_object($hex) || substr($hex,0,2) !== '0x') {
           
            return $hex;
        }
     
        $ascii='';
        
        $hex=str_replace(" ", "", substr($hex, 2));
        for($i=0; $i<strlen($hex); $i=$i+2) {
            $ascii.=chr(hexdec(substr($hex, $i, 2)));
        }
       
        return($ascii);
    }
}
