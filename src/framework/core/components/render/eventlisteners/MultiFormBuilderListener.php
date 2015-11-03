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

/**
 * FormBuilderListener
 *
 * @author Dave Meikle
 */
class MultiFormBuilderListener extends FormBuilderListener {

    public function on_filerender_start($params) {

        if (!array_key_exists('formBuilder', $this->listenerConfig)) {
            throw new Exception('formBuilder key missing from listener config', 508, null);
        } elseif (!array_key_exists('model', $this->listenerConfig)) {
            throw new Exception('model key missing from listener config', 508, null);
        }

        $modelClass = $this->listenerConfig['model'];
        $builderClass = $this->listenerConfig['formBuilder'];
        $formName = $this->listenerConfig['formName'];
        $model = new $modelClass($this->httpRequest, $this->httpResponse, $this->logger);
        $builder = new FormBuilder($this->logger, $model);

        $formBuilder = new $builderClass();

        $this->httpResponse->setAttribute($formName, $formBuilder->buildForm($builder, $this->getValues(), $this->getDependencies(), array()));
    }

}
