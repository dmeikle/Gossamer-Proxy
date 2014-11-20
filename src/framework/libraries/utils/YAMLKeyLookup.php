<?php

namespace libraries\utils;

use libraries\utils\YAMLParser;
use Monolog\Logger;

/**
 * Description of YAMLKeyLookup
 *
 * @author davem
 */
class YAMLKeyLookup {
    
    
    
    public function findURIPatternByYmlKey($ymlkey) {
       
    }
    
    
    public function getPattern($routingPath='') {
        
        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $routingPath);
        $retval = array();
        
        $config = $parser->loadConfig();        
        if(is_array($config)) {
            $retval = $this->parseKeys($config);
        }
        
        $subdirectories = getDirectoryList();        

        foreach ($subdirectories as $folder) {           
            $parser->setFilePath($folder . '/config/routing.yml');
            $config = $parser->loadConfig();
            
            if(is_array($config)) {
                $retval = array_merge($retval, $this->parseKeys($config));
            }
        }

        return $retval;
    }
    
    private function parseKeys(array $config) { 
        $retval = array();
        
        foreach($config as $key => $values){
            $retval[$key] = $values['pattern'];
        }        
        
        return $retval;
    }

    function getDirectoryList() {

        $retval = array();
        if ($handle = opendir(__SITE_PATH . '/src/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/src/components/' . $file;
                }
            }
            closedir($handle);
        }

        return $retval;
    }
}
