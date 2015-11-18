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
 * VendorItemBuilder
 *
 * @author Dave Meikle
 */
class VendorItemBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('VendorItem', $validationResults)) {
            $builder->addValidationResults($validationResults['VendorItem']);
        }
//changed model.item to model.item to prevent collisions with inventory for on edit inventory page
        $builder->add('id', 'hidden', array('value' => $this->getValue('id', $values)))
                ->add('vendorsAutocomplete', 'text', array('ng-model' => 'item.company', 'typeahead' => 'value as value.company for value in fetchVendorsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsVendors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-wait-ms' => '500'))
                ->add('Vendors_id', 'text', array('ng-model' => 'item.Vendors_id', 'ng-init' => "item.Vendors_id ='" . $this->getValue('Vendors_id', $values) . "'", 'class' => 'form-control', 'value' => $this->getValue('Vendors_id', $values)))
                ->add('leadTime', 'text', array('ng-model' => 'item.leadTime', 'ng-init' => "item.leadTime ='" . $this->getValue('leadTime', $values) . "'", 'class' => 'form-control'))
                ->add('InventoryItems_id', 'text', array('ng-model' => 'item.InventoryItems_id', 'ng-init' => "item.InventoryItems_id ='" . $this->getValue('InventoryItems_id', $values) . "'"))
                ->add('price', 'text', array('ng-model' => 'item.price', 'ng-init' => "item.price ='" . $this->getValue('price', $values) . "'", 'class' => 'form-control'))
                ->add('productCode', 'text', array('ng-model' => 'item.productCode', 'ng-init' => "item.productCode ='" . $this->getValue('productCode', $values) . "'", 'class' => 'form-control'))
                ->add('minOrderQuantity', 'text', array('ng-model' => 'item.minOrderQuantity', 'ng-init' => "item.minOrderQuantity ='" . $this->getValue('minOrderQuantity', $values) . "'", 'class' => 'form-control'))
        ;

        if (array_key_exists('packageTypes', $options)) {
            $builder->add('PackageTypes_id', 'select', array('class' => 'form-control', 'options' => $options['packageTypes']));
        }

        return $builder->getForm();
    }

}
