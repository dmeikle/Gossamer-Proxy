<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * DepartmentBuilder
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
                ->add('PackageTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.PackageTypes_id', 'ng-init' => "item.PackageTypes_id ='" . $this->getValue('PackageTypes_id', $values) . "'", 'options' => $options['packageTypes']))
                ->add('price', 'text', array('class' => 'form-control', 'ng-model' => 'item.purchaseCost', 'ng-init' => "item.purchaseCost ='" . $this->getValue('purchaseCost', $values) . "'"))
                ->add('markup', 'text', array('class' => 'form-control', 'ng-model' => 'item.markup', 'ng-init' => "item.markup ='" . $this->getValue('markup', $values) . "'"))
                ->add('taxType', 'text', array('class' => 'form-control', 'ng-model' => 'item.taxType', 'ng-init' => "item.taxType ='" . $this->getValue('taxType', $values) . "'"))
                
                ->add('submit', 'submit', array('class' => 'btn', 'value' => 'Save'))
                ->add('cancel', 'cancel', array('class' => 'btn', 'value' => 'Cancel', 'ng-click' => 'cancel()'))
                ->add('id', 'hidden', array('ng-model' => 'item.id', 'ng-init' => "item.id ='" . $this->getValue('id', $values) . "'"));

        return $builder->getForm();
    }

}
