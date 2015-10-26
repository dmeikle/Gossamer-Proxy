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
 * parses files and returns the key
 *
 * @author Dave Meikle
 */
class YAMLKeyParser extends YAMLParser {

    protected $ymlFilePath = null;
    protected $logger = null;

    /**
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger = null) {
        $this->logger = $logger;
    }

    /**
     *
     * @param string $routingPath
     *
     * @return array
     */
    public function getKeys($routingPath = '') {

        $parser = new YAMLParser($this->logger);
        $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $routingPath);
        $retval = array();

        $config = $parser->loadConfig();
        if (is_array($config)) {
            $retval = $this->parseKeys($config);
        }

        $subdirectories = getDirectoryList('/src/components');
        foreach ($subdirectories as $folder) {
            $parser->setFilePath($folder . '/config/routing.yml');
            $config = $parser->loadConfig();

            if (is_array($config)) {
                $retval = array_merge($retval, $this->parseKeys($config));
            }
        }
        return $retval;
    }

    /**
     * finds the config node by its key and $_REQUEST method
     *
     * @param string $ymlkey
     * @param string $filename
     * @param string $method
     *
     * @return array
     */
    public function getNodeByKey($ymlkey, $filename, $method = 'GET') {

        //first check core components
        $result = $this->searchKeyInCore($ymlkey, $filename, $method);
        if (!is_null($result) && is_array($result)) {
            return $result;
        }

        //now check user components
        return $this->searchKeyInSrc($ymlkey, $filename, $method);
    }

    /**
     * finds node based on key, looking in the framework component config folders
     *
     * @param string $ymlkey
     * @param string $filename
     * @param string $method
     *
     * @return array
     */
    private function searchKeyInCore($ymlkey, $filename, $method = 'GET') {
        $subdirectories = $this->getDirectoryList('/src/framework/core/components/');

        $parser = new YAMLParser($this->logger);
        foreach ($subdirectories as $folder) {

            $parser->setFilePath($folder . '/config/' . $filename . '.yml');
            $config = $parser->loadConfig();

            if (is_array($config) && array_key_exists($ymlkey, $config)) {
                //check to see if it's the correct key based on its methodType
                if (array_key_exists('methods', $config[$ymlkey]) && in_array($method, $config[$ymlkey]['methods'])) {
                    return $config[$ymlkey];
                } elseif (!array_key_exists('methods', $config)) {
                    //no method specified, so it's ok to use
                    return $config[$ymlkey];
                }
            }
        }

        return null;
    }

    /**
     * finds node based on key, looking in the src component config folders
     *
     * @param string $ymlkey
     * @param string $filename
     * @param string $method
     *
     * @return array
     */
    private function searchKeyInSrc($ymlkey, $filename, $method = 'GET') {
        $subdirectories = $this->getDirectoryList('/src/components/');
        $parser = new YAMLParser($this->logger);

        foreach ($subdirectories as $folder) {

            $parser->setFilePath($folder . '/config/' . $filename . '.yml');
            $config = $parser->loadConfig();

            if (is_array($config) && array_key_exists($ymlkey, $config)) {
                //check to see if it's the correct key based on its methodType
                if (array_key_exists('methods', $config[$ymlkey]) && in_array($method, $config[$ymlkey]['methods'])) {
                    return $config[$ymlkey];
                }

                if (!array_key_exists('methods', $config[$ymlkey])) {
                    //no method type specified so just return it as is
                    return $config[$ymlkey];
                }
            }
        }

        return null;
    }

    /**
     *
     * @param array $config
     *
     * @return array
     */
    private function parseKeys(array $config) {
        $retval = array();

        foreach ($config as $key => $values) {
            $retval[$key] = $values['pattern'];
        }

        return $retval;
    }

    /**
     *
     * @param string $folderPath
     *
     * @return string
     */
    function getDirectoryList($folderPath) {

        $retval = array();
        if ($handle = opendir(__SITE_PATH . $folderPath)) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . $folderPath . $file;
                }
            }
            closedir($handle);
        }

        return $retval;
    }

}
