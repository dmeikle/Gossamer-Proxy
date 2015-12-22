<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * InventoryBuilder
 *
 * @author Dave Meikle
 */
class InventoryBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Department', $validationResults)) {
            $builder->addValidationResults($validationResults['Department']);
        }

        $builder->add('department', 'text', array('class' => 'form-control', 'value' => $this->getValue('department'), $values))

                //Advanced Search
                ->add('warehouseLocations', 'select', array('class' => 'form-control', 'ng-model' => 'advancedSearch.query.warehouseLocation', 'options' => $options['warehouseLocations']))
                ->add('vehicles', 'select', array('class' => 'form-control', 'ng-model' => 'advancedSearch.query.vehicle', 'options' => $options['vehicles']))
                ->add('jobNumber', 'text', array('ng-model' => 'item.jobNumber', 'uib-typeahead' => 'value as value.jobNumber for value in fetchClaimsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsClaim', 'class' => 'form-control typeahead col-md-12',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getClaimsID(claim)', 'typeahead-wait-ms' => '500'));
        return $builder->getForm();
    }

}
