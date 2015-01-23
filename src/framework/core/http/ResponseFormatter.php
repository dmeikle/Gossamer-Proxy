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

use libraries\utils\YAMLConfiguration;
use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;


class ResponseFormatter
{    
  
    /**
     * if true, the system will throw an error if a URI is not specified for exposing elements.
     * if false, the system will output ALL values in the registry if the URI is not located in the XML config file.
     */
    const PARANOID_MODE = FALSE;

    /**
     * format - prune the registry based on xml config
     *
     * @param string    XMLpath
     * @param Registry  registry
     *
     * @return array
     */
    public static function format(YAMLConfiguration $params, HTTPRequest $request, HTTPResponse &$response, Logger $logger) {
 
        $attributes = $request->getAttributes();
  
        $output = array();

        if (count($params) < 1) {
            if (self::PARANOID_MODE) {
                $logger->addError('XML is missing CherryPicker configs for ' . $uri);
                throw new XMLNodeNotConfiguredException('need to customize error for YAML configs for ' . $uri);
            }
      
            //not paranoid? ok - dump the whole registry to the user
            foreach($attributes as $key => $value) {
                $output[self::trimNamespacing($key)] = $attributes[$key];
            }
            return $output;
        }
        $configs = array_filter($params->getConfigs());
        
        foreach($configs as $key => $outputSet) {
         // pr($outputSet); 
          //  exit;
           foreach($outputSet as $className => $columns) {           
               if(is_array($outputSet)) {
                    self::formatArray($className, $columns, $output, $attributes, $logger);   
               }               
           }
        }

      $response = new HTTPResponse($output);
     
    }

    /**
     * formatArray - takes the value located in the yml file, pulls it from the registry
     * and adds it to the output array.
     *
     * @param string    className - element name we are parsing
     * @param array     columns - the array of exposable values
     * @param array     output - the return value
     * @param array     attributes - the list to parse
     * @param Logger    logger - the logging object
     */
     
    private static function formatArray($className, array $columns, &$output = array(), array $attributes, Logger $logger) {
    
        if(!array_key_exists($className, $attributes)) {
            return;
        }
        $list = $attributes[$className];
       
        $columns = array_flip($columns);
       if(is_array(current($list))){
            foreach($list as $row) {
                $newRow = array_intersect_key($row, $columns);
                $output[self::trimNamespacing($className)][] = $newRow;
             }
        } else {
            
            $newRow = array_intersect_key($list, $columns);
                $output[self::trimNamespacing($className)][] = $newRow;
        }
        
        
    }


    private static function trimNamespacing($key) {
        $chunks = explode('\\', $key);
        return array_pop($chunks);
    }
    
}
