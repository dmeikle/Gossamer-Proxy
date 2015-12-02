<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\angular\routing;

use core\system\Router;

/**
 * Router
 *
 * @author Dave Meikle
 */
class Router extends Router {

    public function getQualifiedUrl($ymlkey, $params = null) {
        $node = $this->getURLByYamlKey($ymlkey);

        if (is_null($node)) {
            throw new RedirectKeyNotFoundException('Router redirect key not found - check method [GET|POST]?');
        }

        $ymlURI = $node['pattern'];

        return $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI, $params);
    }

    protected function getURLByYamlKey($ymlkey) {
        $loader = new YAMLKeyParser($this->logger);

        $node = $loader->getNodeByKey($ymlkey, 'routing');

        if (!is_null($node) && count($node) > 0) {
            return $node;
        }
    }

    protected function parseRequestUriParameters($uri, $ymlURI, array $params = null) {
        $uriList = explode('/', $uri);
        $rawUriList = explode('/', $ymlURI);
        if (is_null($params)) {
            return $ymlURI;
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

        return substr($rawList, 1);
    }

}
