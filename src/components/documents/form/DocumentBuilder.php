<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\documents\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * DepartmentBuilder
 *
 * @author Dave Meikle
 */
class DocumentBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Document', $validationResults)) {
            $builder->addValidationResults($validationResults['Document']);
        }

        if (array_key_exists('documentTypes', $options)) {
            $builder->add('DocumentTypes_id', 'select', array('ng-model' => 'upload.DocumentTypes_id', 'class' => 'form-control', 'options' => $options['documentTypes']));
        }

        if (array_key_exists('claimLocations', $options)) {
            $builder->add('ClaimsLocations_id', 'select', array('ng-model' => 'upload.ClaimsLocations_id', 'class' => 'form-control', 'multiple' => 'multiple', 'options' => $options['claimLocations']));
        }

        return $builder->getForm();
    }

}
