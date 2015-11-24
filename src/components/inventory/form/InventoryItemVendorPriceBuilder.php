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
class InventoryItemVendorPriceBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('VendorItem', $validationResults)) {
            $builder->addValidationResults($validationResults['VendorItem']);
        }

        $builder->add('id', 'hidden', array('ng-model' => 'row.id', 'ng-init' => "item.id ='" . $this->getValue('id', $values) . "'", 'value' => $this->getValue('id', $values)))
                ->add('vendorsAutocomplete', 'text', array('ng-model' => 'row.company', 'typeahead' => 'value as value.company for value in fetchVendorsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsVendors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-wait-ms' => '500', 'typeahead-on-select' => 'setVendorId(row)'))
                ->add('Vendors_id', 'text', array('ng-model' => 'row.Vendors_id', 'ng-init' => "item.Vendors_id ='" . $this->getValue('Vendors_id', $values) . "'", 'class' => 'form-control', 'value' => $this->getValue('Vendors_id', $values)))
                ->add('leadTime', 'text', array('ng-model' => 'row.leadTime', 'ng-init' => "item.leadTime ='" . $this->getValue('leadTime', $values) . "'", 'class' => 'form-control'))
                ->add('InventoryItems_id', 'text', array('ng-model' => 'row.InventoryItems_id', 'ng-init' => "item.InventoryItems_id ='" . $this->getValue('InventoryItems_id', $values) . "'"))
                ->add('price', 'text', array('ng-model' => 'row.price', 'ng-init' => "item.price ='" . $this->getValue('price', $values) . "'", 'class' => 'form-control'))
                ->add('productCode', 'text', array('ng-model' => 'row.productCode', 'ng-init' => "item.productCode ='" . $this->getValue('productCode', $values) . "'", 'class' => 'form-control'))
                ->add('numPerBox', 'text', array('ng-model' => 'row.numPerBox', 'ng-init' => "item.numPerBox ='" . $this->getValue('numPerBox', $values) . "'", 'class' => 'form-control'))
                ->add('isPreferredVendor', 'radio', array('ng-model' => 'row.isPreferredVendor', 'ng-init' => "item.isPreferredVendor ='" . $this->getValue('isPreferredVendor', $values) . "'", 'value' => '1'))
                ->add('minOrderQuantity', 'text', array('ng-model' => 'row.minOrderQuantity', 'ng-init' => "item.minOrderQuantity ='" . $this->getValue('minOrderQuantity', $values) . "'", 'class' => 'form-control'))
        ;

        if (array_key_exists('packageTypes', $options)) {
            $builder->add('PackageTypes_id', 'select', array('ng-model' => 'row.PackageTypes_id', 'class' => 'form-control', 'options' => $options['packageTypes']));
        }

        return $builder->getForm();
    }

}
