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
 * YamlFileIterator
 *
 * @author Dave Meikle
 */
class YamlFileIterator {

    private $logger = null;

    public function __construct(Logger $logger = null) {
        $this->logger = $logger;
    }

    public function loadAllYamlFiles() {
        $parser = new YAMLParser($this->logger);
        $directories = getDirectoryList();

        $retval = array();
        foreach ($directories as $directory) {
            $parser->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $directory);
            $parser->setFilePath($directory . '/config/routing.yml');
            $config = $parser->loadConfig();

            if (is_array($config)) {
                $retval = array_merge($retval, $config);
            }
        }


        return $retval;
    }

    public function parseYamlKeys(array $keys) {
        $yaml = $this->loadAllYamlFiles();

        $retval = array();
        foreach ($yaml as $nodeKey => $node) {
            if (array_key_exists('ng', $node)) {
                $retval = array_merge($retval, array($nodeKey => $node['ng']));
                pr($retval);
            }
            // $newNode = array_intersect_key($node, $keys);
            $newNode = $this->intersectArray($node, $keys);

            $retval = array_merge($retval, array($nodeKey => $newNode));
        }

        return $retval;
    }

    private function intersectArray($main, $checkFor) {
        $retval = array();
        foreach ($checkFor as $key) {
            if (array_key_exists($key, $main)) {
                $retval[$key] = $main[$key];
            }
        }

        return $retval;
    }

}
