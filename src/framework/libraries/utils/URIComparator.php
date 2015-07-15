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

use Gossamer\Caching\CacheManager;

/**
 * iterates yml configurations for a matching URI pattern
 * 
 * @author Dave Meikle
 */
class URIComparator {

    private $cacheManager = null;
    
    public function __construct(CacheManager $cacheManager = null) {
        $this->cacheManager = $cacheManager;   
    }
    
    /**
     * 
     * @param array $config
     * @param string $uri
     * 
     * @return boolean
     */
    public function findPattern($config, $uri) {
        $key = $this->retrieveFromCache($uri, true);
        if(!is_null($key) && $key !== false) {
         
            return $key;
        }
        
        foreach ($config as $outerkey => $grouping) {

            if (array_key_exists('methods', $grouping)) {
                $method = current($grouping['methods']);

                if ($method != __REQUEST_METHOD) {
                    continue;
                }
            }
            if (array_key_exists('pattern', $grouping)) {

                if ($grouping['pattern'] == $uri) {
                    $this->saveToCache($uri, $outerkey);
                    
                    return $outerkey;
                }
                file_put_contents('/var/www/phoenix-portal/logs/routing.log',$uri . " = " . $grouping['pattern']."\r\n", FILE_APPEND);
                if ($this->parseWildCard($uri, $grouping['pattern'])) {
                    $this->saveToCache($uri, $outerkey);
                    
                    return $outerkey;
                }
            }
        }

        return false;
    }

    private function retrieveFromCache($uri) {
        if(is_null($this->cacheManager)) {
           
            return false;
        }
  
      
        $routing = $this->cacheManager->retrieveFromCache('routing/' . $this->sanitizeFilename($uri), true);
      
        return $routing;
        
    }
    
    private function saveToCache($uri, $config) {
        if(is_null($this->cacheManager)) {
            return false;
        }
     
        $this->cacheManager->saveToCache('routing/' . $this->sanitizeFilename($uri), $config);
    }
    
    /**
    * Sanitizes a filename replacing whitespace with dashes
    *
    * Removes special characters that are illegal in filenames on certain
    * operating systems and special characters requiring special escaping
    * to manipulate at the command line. Replaces spaces and consecutive
    * dashes with a single dash. Trim period, dash and underscore from beginning
    * and end of filename.
    *
    * @since 2.1.0
    *
    * @param string $filename The filename to be sanitized
    * @return string The sanitized filename
    */
   function sanitizeFilename($string = '', $is_filename = FALSE)
    {
      
       $pieces = explode('/', $string);
       $chunk = array_pop($pieces);
        $str = strip_tags($chunk); 
        $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
        $str = strtolower($str);
        $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
        $str = htmlentities($str, ENT_QUOTES, "utf-8");
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = str_replace(' ', '-', $str);
        $str = rawurlencode($str);
        $str = str_replace('%', '-', $str);

        return implode(DIRECTORY_SEPARATOR, $pieces)  . DIRECTORY_SEPARATOR . $str . '_' . __REQUEST_METHOD;
       
   }

    /**
     * finds a matching pattern with a wildcard in it
     * 
     * @param string $uri
     * @param string $pageName
     * 
     * @return boolean
     */
    protected function parseWildCard($uri, $pageName) {

        //knock of the trailing parameters at end of URI
        $chunks = explode('?', $uri);
        $trimmedChunks = rtrim($chunks[0], '/');
        //this is based on URI
        $uriPieces = (explode('/', $trimmedChunks));

        if (current($uriPieces) == '') {
            array_shift($uriPieces);
        }
        //this is based on config file - remove array_filter as it was dropping last chunk
        $pagePieces = (explode('/', $pageName));

        if (count($uriPieces) != count($pagePieces) || count($pagePieces) < 1) {

            return false;
        }


        for ($i = 0; $i < count($uriPieces); $i++) {
            if (array_key_exists($i, $pagePieces)) {
                if ($pagePieces[$i] == '*') {

                    continue;
                }

                if ($pagePieces[$i] != $uriPieces[$i]) {

                    return false;
                }
            }
        }

        return true;
    }

}
