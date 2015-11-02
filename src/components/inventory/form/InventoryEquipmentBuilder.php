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
 * InventoryEquipmentBuilder
 *
 * @author Dave Meikle
 */
class InventoryEquipmentBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        pr($values);
        if (is_array($validationResults) && array_key_exists('InventoryEquipment', $validationResults)) {
            $builder->addValidationResults($validationResults['InventoryEquipment']);
        }
        $builder->add('id', 'hidden', array('class' => 'form-control', 'ng-model' => 'item.id', 'ng-init' => "item.id ='" . $this->getValue('id', $values) . "'"))
                ->add('InventoryItems_id', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItems_id', 'ng-init' => "item.InventoryItems_id ='" . $this->getValue('InventoryItems_id', $values) . "'"))
                ->add('price', 'text', array('class' => 'form-control', 'ng-model' => 'item.price', 'ng-init' => "item.price ='" . $this->getValue('price', $values) . "'"))
                ->add('maxDays', 'text', array('class' => 'form-control', 'ng-model' => 'item.maxDays', 'ng-init' => "item.maxDays ='" . $this->getValue('maxDays', $values) . "'"));

        if (array_key_exists('packageTypes', $options)) {
            $builder->add('PackageTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.PackageTypes_id', 'ng-init' => "item.InventoryItem.PackageTypes_id ='" . $this->getValue('PackageTypes_id', $values) . "'", 'options' => $options['packageTypes']));
        }

        $builder->add('name', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.InventoryItem.name', 'ng-init' => "item.InventoryItem.name ='" . $this->getValue('name', $values['InventoryItem']) . "'"))
                ->add('productCode', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.productCode', 'ng-init' => "item.InventoryItem.productCode ='" . $this->getValue('productCode', $values['InventoryItem']) . "'"))
                ->add('description', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.description', 'ng-init' => "item.InventoryItem.description ='" . $this->getValue('description', $values['InventoryItem']) . "'"))
                ->add('minOrderQuantity', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.minOrderQuantity', 'ng-init' => "item.InventoryItem.minOrderQuantity ='" . $this->getValue('minOrderQuantity', $values['InventoryItem']) . "'"))
                ->add('maxQuantity', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.maxQuantity', 'ng-init' => "item.InventoryItem.maxQuantity ='" . $this->getValue('maxQuantity', $values['InventoryItem']) . "'"))
                ->add('number', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.number', 'ng-init' => "item.InventoryItem.number ='" . $this->getValue('number', $values['InventoryItem']) . "'"))
                ->add('maxDays', 'text', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.maxDays', 'ng-init' => "item.InventoryItem.maxDays ='" . $this->getValue('maxDays', $values['InventoryItem']) . "'"))
                ->add('InventoryTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.InventoryItem.InventoryTypes_id', 'ng-init' => "item.InventoryItem.InventoryTypes_id ='" . $this->getValue('InventoryTypes_id', $values) . "'", 'options' => $options['inventoryTypes']))
                ->add('submit', 'submit', array('class' => 'btn', 'value' => 'Save'))
                ->add('cancel', 'cancel', array('class' => 'btn', 'value' => 'Cancel'))
                ->add('id', 'hidden', array('ng-model' => 'item.id', 'ng-init' => "item.id ='" . $this->getValue('id', $values) . "'"));

        return $builder->getForm();
    }

}
