<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\system;

use core\system\YamlRouter;
use Gossamer\Caching\CacheManager;
use libraries\utils\YamlFileIterator;
use Monolog\Logger;
use core\http\HTTPRequest;
use exceptions\LangFileNotSpecifiedException;

/**
 * RenderRouter
 *
 * @author Dave Meikle
 */
class RenderRouter extends YamlRouter {

    private $langFileLoader = null;

    public function __construct(Logger &$logger = null, HTTPRequest &$httpRequest) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->langFileLoader = $httpRequest->getAttribute('langFiles');
    }

    protected function getURLByYamlKey($ymlKey) {
        $routing = $this->loadRoutingConfiguration();
        if (array_key_exists($ymlKey, $routing)) {
            $node = $routing[$ymlKey];

            return $node;
        }
    }

    protected function loadRoutingConfiguration() {
        $manager = new CacheManager($this->logger);
        $routing = $manager->retrieveFromCache('routing_links_angular');
        if ($routing === false) {
            $routing = $this->generateYamlKeyList();
            $manager->saveToCache('routing_links_angular', $routing);
        }

        return $routing;
    }

    protected function generateYamlKeyList() {
        $it = new YamlFileIterator();

        return $it->parseYamlKeys(array('pattern', 'ng'));
    }

    protected function parseRequestUriParameters($uri, $ymlURI, array $params = null) {
        $uriList = explode('/', $uri);

        $rawUriList = explode('/', $ymlURI['pattern']);
        if (is_null($params)) {
            return '/' . $ymlURI['pattern'];
            //let's assume the programmer is wanting to re-use the hold params.
            // redirecting to the previous page perhaps?
            // return implode('/', array_slice($uriList, -(count($rawUriList))));
        }
        //we have params - let's rebuild the uri with the passed params
        $rawList = '';
        foreach ($rawUriList as $chunk) {
            if ($chunk == '*') {
                //pop the first element off the array
                $rawList .= '/' . array_shift($params);
            } else {
                $rawList .= '/' . $chunk;
            }
        }
        $ngLink = '';
        if (array_key_exists('ng', $ymlURI)) {
            $ngLink = $this->getNgParams($ymlURI['ng']);
        }

        return 'href="/' . substr($rawList, 1) . '" ' . $ngLink;
    }

    private function getNgParams(array $item) {
        if (array_key_exists('ng-click', $item)) {
            $tmp = str_replace('text_key', $this->getString($item['text_key']), $item['ng-click']);
            $ngLink = str_replace('template', $this->getString($item['template']), $tmp);
        }

        return $ngLink;
    }

    /**
     * used for getting a string value from a locale file based on its key
     *
     * @param string $key
     * @return string
     *
     * @throws LangFileNotSpecifiedException
     */
    public function getString($key) {
        if (is_null($this->langFileLoader)) {
            throw new LangFileNotSpecifiedException("LangFileLoader is null - cannot request a string. Check node configuration for langfile element");
        }

        return $this->langFileLoader->getString($key);
    }

}
