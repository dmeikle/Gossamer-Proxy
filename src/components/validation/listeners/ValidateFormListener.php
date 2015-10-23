<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\validation\listeners;

use core\eventlisteners\AbstractListener;
use Validation\Validator;
use Validation\YamlConfiguration;
use core\http\HTTPResponse;
use core\http\HTTPRequest;
use Monolog\Logger;
use core\system\Router;

class ValidateFormListener extends AbstractListener {

    protected $validator = null;

    public function __construct(Logger $logger, HTTPRequest &$httpRequest, HTTPResponse $httpResponse, $validatorName = null) {
        $this->logger = $logger;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;

        $loader = new YamlConfiguration();

        $loader->loadConfig(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/config/validation/' . __YML_KEY . '.yml');

        if (is_null($validatorName)) {
            $this->validator = new Validator($loader, $this->logger);
        } else {
            $this->validator = new $validatorName($loader, $this->logger);
        }
    }

    protected function validate($params = array()) {

        $result = $this->validator->validateRequest($this->httpRequest->getPost(), true);

        if (is_array($result) && count($result) > 0) {

            setSession('ERROR_RESULT', $result);
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());

            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($result['FAIL_KEY'], $this->httpRequest->getParameters());
        }

        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', NULL);
    }

    public function on_request_start($params = array()) {
        $this->validate($params);
    }

    public function on_entry_point($params = array()) {
        $this->validate($params);
    }

    private function formatPostedArrayforFramework() {
        $retval = array();
        $key = key($this->httpRequest->getPost());
        $retval[$key][] = current($this->httpRequest->getPost());

        return $retval;
    }

}
