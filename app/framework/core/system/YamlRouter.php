<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\system;

use Monolog\Logger;
use exceptions\RedirectKeyNotFoundException;
use libraries\utils\YAMLKeyParser;
use core\http\HTTPRequest;
use Gossamer\Caching\CacheManager;
use libraries\utils\YamlFileIterator;

/**
 * Used for redirecting a request to a new URI
 *
 * @author Dave Meikle
 */
class YamlRouter extends Router {

    public function getQualifiedUrl($ymlkey, $params = null) {
        $ymlURI = $this->getURLByYamlKey($ymlkey);

        if (is_null($ymlURI)) {
            throw new RedirectKeyNotFoundException('Router redirect key not found - check method [GET|POST]?');
        }

        return $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI, $params);
    }

    protected function getURLByYamlKey($ymlKey) {
        $routing = $this->loadRoutingConfiguration();
        if (array_key_exists($ymlKey, $routing)) {
            $node = $routing[$ymlKey];

            return $node['pattern'];
        }
    }

    protected function loadRoutingConfiguration() {
        $manager = new CacheManager($this->logger);
        $routing = $manager->retrieveFromCache('routing_links');
        if ($routing === false) {
            $routing = $this->generateYamlKeyList();
            $manager->saveToCache('routing_links', $routing);
        }

        return $routing;
    }

    protected function generateYamlKeyList() {
        $it = new YamlFileIterator();

        return $it->parseYamlKeys(array('pattern'));
    }

}
