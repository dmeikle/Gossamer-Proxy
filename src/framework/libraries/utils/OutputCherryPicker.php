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
/**
 * OutputCherryPicker - prunes the registry object and only exposes values the xml
 *                      config specifies as allowable
 *
 * Author: Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class OutputCherryPicker
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
    public static function format($xmlFilePath, $uri, Registry $registry)
    {

        $xml = file_get_contents($xmlFilePath);
        $xmlParser = new XMLParser();
        $params = $xmlParser->parse($xml, $uri, 'outputParam');

        unset($xmlParser);
        $output = array();

        if (count($params) < 1) {
            if (self::PARANOID_MODE) {
                error_log('XML is missing CherryPicker configs for ' . $uri);
                throw new XMLNodeNotConfiguredException('XML is missing CherryPicker configs for ' . $uri);
            }

            //not paranoid? ok - dump the whole registry to the user
            foreach($registry->toArray() as $key => $value) {
                $output[self::trimNamespacing($key)] = $registry->$key;
            }
            return $output;
        }



        foreach ($params as $key) {
            self::formatValue($key, $output, $registry);
        }

        return $output;
    }

    /**
     * formatValue - takes the value located in the xml file, pulls it from the registry
     * and adds it to the output array.
     *
     * @param key       string - element name
     * @param array     output - the array of exposable values
     * @param Registry  registry - the array of loaded items to cherry pick values from
     */
    private static function formatValue($key, &$output = array(), Registry &$registry)
    {

        $keyParts = explode('::', $key);

        if (count($keyParts) > 1) {
            $output[str_replace('::', '_', self::trimNamespacing($key))] = $registry->$keyParts[0]->$keyParts[1];
        } else {
            $output[self::trimNamespacing($key)] = $registry->$key;
        }
    }

	private static function trimNamespacing($key) {
		$chunks = explode('\\', $key);
		return array_pop($chunks);
	}

}
