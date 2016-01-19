<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils\traits;

use Gossamer\Caching\CacheManager;
use libraries\utils\YamlFileIterator;

/**
 * LoadConfigFile
 *
 * @author Dave Meikle
 */
trait LoadConfigFile {

    protected function loadConfig() {
        $loader = new \libraries\utils\YAMLParser();
        $loader->setFilePath(__CONFIG_PATH . 'config.yml');

        return $loader->loadConfig();
    }

    public function loadComponentConfig($ymlkey, $filename = 'routing') {

        $loader = new \libraries\utils\YAMLKeyParser();

        return $loader->getNodeByKey($ymlkey, $filename);
    }

    public function loadCachedComponentConfig($ymlKey, $cacheKey, $filename = 'routing', $includeAppFolder = false) {
        $manager = new CacheManager($this->logger);
        $routing = $manager->retrieveFromCache($cacheKey);
        if ($routing === false) {
            $routing = $this->generateCachableYamlKeyList($filename, $includeAppFolder);
            $manager->saveToCache($cacheKey, $routing);
        }

        return $routing;
    }

    protected function generateCachableYamlKeyList($filename, $includeAppFolder = false) {
        $it = new YamlFileIterator();

        return $it->loadAllYamlFiles($filename, $includeAppFolder);
    }

}
