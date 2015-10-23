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

/**
 * Used for redirecting a request to a new URI
 *
 * @author Dave Meikle
 */
class Router {

    private $logger = null;
    private $httpRequest = null;

    public function __construct(Logger &$logger = null, HTTPRequest &$httpRequest) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
    }

    public function getQualifiedUrl($ymlkey, $params = null) {
        $ymlURI = $this->getURLByYamlKey($ymlkey);

        if (is_null($ymlURI)) {
            throw new RedirectKeyNotFoundException('Router redirect key not found - check method [GET|POST]?');
        }

        return $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI, $params);
    }

    public function redirect($ymlkey, array $params = null) {

        $ymlURI = $this->getURLByYamlKey($ymlkey);

        if (is_null($ymlURI)) {
            throw new RedirectKeyNotFoundException('Router redirect key not found - check method [GET|POST]?');
        }
        $redirectUrl = $this->parseRequestUriParameters($this->httpRequest->getAttribute('HTTP_REFERER'), $ymlURI, $params);

        if (!is_null($this->logger->addDebug('redirecting to ' . $redirectUrl)))
            ;
        /* Redirect browser */
        header("Location: /$redirectUrl");
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    }

    private function getURLByYamlKey($ymlkey) {
        $loader = new YAMLKeyParser($this->logger);

        $node = $loader->getNodeByKey($ymlkey, 'routing');

        if (!is_null($node) && count($node) > 0) {
            return $node['pattern'];
        }
    }

    private function parseRequestUriParameters($uri, $ymlURI, array $params = null) {
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
