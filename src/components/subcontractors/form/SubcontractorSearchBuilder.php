<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\subcontractors\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * SubcontractorSearchBuilder
 *
 * @author Dave Meikle
 */
class SubcontractorSearchBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('SubcontractorBuilder', $validationResults)) {
            $builder->addValidationResults($validationResults['SubcontractorBuilder']);
        }
        if (is_array($values) && array_key_exists('SubcontractorBuilder', $values)) {
            $values = current($values['SubcontractorBuilder']);
        }

        $builder->add('jobNumber', 'text', array('ng-model' => 'advancedSearch.query.jobNumber', 'class' => 'form-control'));

        if (array_key_exists('subcontractorTypes', $options)) {
            $builder->add('SubcontractorTypes_id', 'select', array('ng-model' => 'advancedSearch.query.SubcontractorTypes_id', 'class' => 'form-control', 'options' => $options['subcontractorTypes']));
        }

        return $builder->getForm();
    }

}
