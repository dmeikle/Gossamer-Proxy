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
 * InventoryItem
 *
 * @author Dave Meikle
 */
class InventoryItemBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('InventoryItem', $validationResults)) {
            $builder->addValidationResults($validationResults['InventoryItem']);
        }

        $builder->add('name', 'text', array('class' => 'form-control', 'ng-model' => 'item.name'))
                ->add('productCode', 'text', array('class' => 'form-control', 'ng-model' => 'item.productCode'))
                ->add('description', 'text', array('class' => 'form-control', 'ng-model' => 'item.description'))
                ->add('PackageTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.PackageTypes_id', 'options' => $options['packageTypes']))
                ->add('price', 'text', array('class' => 'form-control', 'ng-model' => 'item.price'))
                ->add('markup', 'text', array('class' => 'form-control', 'ng-model' => 'item.markup'))
                ->add('taxType', 'select', array('class' => 'form-control', 'ng-model' => 'item.AccountingTaxTypes_id', 'options' => $options['taxTypes']))
                
                ->add('submit', 'submit', array('class' => 'btn', 'value' => 'Save'))
                ->add('cancel', 'cancel', array('class' => 'btn', 'value' => 'Cancel', 'ng-click' => 'cancel()'))
                ->add('id', 'hidden', array('ng-model' => 'item.id'));

        return $builder->getForm();
    }

}
