<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\eventlisteners;

use Gossamer\CMS\Forms\FormBuilder;
use core\components\render\serialization\DependencySerializer;

/**
 * FormBuilderListener
 *
 * @author Dave Meikle
 */
class FormBuilderListener extends \core\eventlisteners\AbstractCachableListener {

    public function on_filerender_start($params) {

        if (!array_key_exists('formBuilder', $this->listenerConfig)) {
            throw new Exception('formBuilder key missing from listener config', 508, null);
        } elseif (!array_key_exists('model', $this->listenerConfig)) {
            throw new Exception('model key missing from listener config', 508, null);
        }

        $modelClass = $this->listenerConfig['model'];
        $builderClass = $this->listenerConfig['formBuilder'];

        $model = new $modelClass($this->httpRequest, $this->httpResponse, $this->logger);
        $builder = new FormBuilder($this->logger, $model);

        $formBuilder = new $builderClass();

        $this->httpResponse->setAttribute('form', $formBuilder->buildForm($builder, $this->getValues(), $this->getDependencies(), array()));
    }

    protected function getDependencies() {
        if (!array_key_exists('dependencies', $this->listenerConfig) || count($this->listenerConfig['dependencies']) == 0) {
            return array();
        }

        $retval = array();

        foreach ($this->listenerConfig['dependencies'] as $dependency) {
            if (!array_key_exists('model', $dependency) && array_key_exists('key', $dependency)) {
                $retval[$dependency['key']] = $this->formatDependency($dependency);
            }
        }

        return $retval;
    }

    protected function getValues() {
        if (!array_key_exists('dependencies', $this->listenerConfig) || count($this->listenerConfig['dependencies']) == 0) {
            return array();
        }
        foreach ($this->listenerConfig['dependencies'] as $dependency) {

            if (array_key_exists('model', $dependency)) {

                return $this->httpRequest->getAttribute($dependency['dependency']);
            }
        }

        return array();
    }

    protected function formatDependency(array $dependency) {
        $serializer = new DependencySerializer();

        if (array_key_exists('formatting', $dependency) && $dependency['formatting'] == 'raw') {
            return $this->httpRequest->getAttribute($dependency['dependency']);
        }

        return $serializer->formatSelectionBox($dependency['value'], $dependency['text'], $this->httpRequest->getAttribute($dependency['dependency']));
    }

    public function on_request_start($params) {
        $this->on_filerender_start($params);
    }

    public function on_request_end($params) {
        $this->on_filerender_start($params);
    }

}
