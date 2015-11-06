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
 * InventoryItemBuilder
 *
 * @author Dave Meikle
 */
class InventoryItemBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('InventoryItem', $validationResults)) {
            $builder->addValidationResults($validationResults['InventoryItem']);
        }

        $builder->add('name', 'text', array('class' => 'form-control', 'ng-model' => 'item.name', 'ng-init' => "item.name ='" . $this->getValue('name', $values) . "'"))
                ->add('productCode', 'text', array('class' => 'form-control', 'ng-model' => 'item.productCode', 'ng-init' => "item.productCode ='" . $this->getValue('productCode', $values) . "'"))
                ->add('description', 'text', array('class' => 'form-control', 'ng-model' => 'item.description', 'ng-init' => "item.description ='" . $this->getValue('description', $values) . "'"))
                ->add('minOrderQuantity', 'text', array('class' => 'form-control', 'ng-model' => 'item.minOrderQuantity', 'ng-init' => "item.minOrderQuantity ='" . $this->getValue('minOrderQuantity', $values) . "'"))
                ->add('maxQuantity', 'text', array('class' => 'form-control', 'ng-model' => 'item.maxQuantity', 'ng-init' => "item.maxQuantity ='" . $this->getValue('maxQuantity', $values) . "'"))
                ->add('PackageTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.PackageTypes_id', 'ng-init' => "item.PackageTypes_id ='" . $this->getValue('PackageTypes_id', $values) . "'", 'options' => $options['packageTypes']))
                ->add('number', 'text', array('class' => 'form-control', 'ng-model' => 'item.number', 'ng-init' => "item.number ='" . $this->getValue('number', $values) . "'"))
                ->add('maxDays', 'text', array('class' => 'form-control', 'ng-model' => 'item.maxDays', 'ng-init' => "item.maxDays ='" . $this->getValue('maxDays', $values) . "'"))
                ->add('InventoryTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.InventoryTypes_id', 'ng-init' => "item.InventoryTypes_id ='" . $this->getValue('InventoryTypes_id', $values) . "'", 'options' => $options['inventoryTypes']))
                ->add('InventoryCategories_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.InventoryCategories_id', 'ng-init' => "item.InventoryCategories_id ='" . $this->getValue('InventoryCategories_id', $values) . "'", 'options' => $options['inventoryCategorys']))
                ->add('AccountingTaxTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.AccountingTaxTypes_id', 'ng-init' => "item.AccountingTaxTypes_id ='" . $this->getValue('AccountingTaxTypes_id', $values) . "'", 'options' => $options['accountingTaxTypes']))
                ->add('WarehouseLocations_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.WarehouseLocations_id', 'ng-init' => "item.WarehouseLocations_id ='" . $this->getValue('WarehouseLocations_id', $values) . "'", 'options' => $options['warehouses']))
                ->add('markup', 'text', array('class' => 'form-control', 'ng-model' => 'item.markup', 'ng-init' => "item.markup ='" . $this->getValue('markup', $values) . "'"))
                ->add('submit', 'submit', array('class' => 'btn', 'value' => 'Save'))
                ->add('cancel', 'cancel', array('class' => 'btn', 'value' => 'Cancel'))
                ->add('id', 'hidden', array('ng-model' => 'item.id', 'ng-init' => "item.id ='" . $this->getValue('id', $values) . "'"));

        return $builder->getForm();
    }

}
