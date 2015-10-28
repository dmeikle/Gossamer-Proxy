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
 * Purchase Order
 *
 * @author Dave Meikle
 */
class PurchaseOrderBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('PurchaseOrder', $validationResults)) {
            $builder->addValidationResults($validationResults['PurchaseOrder']);
        }

        $builder->add('Vendors_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.Vendors_id', 'options' => $options['vendors']))
                ->add('Departments_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.Departments_id', 'options' => $options['departments']))
                ->add('AccountingPaymentsMethods_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.AccountingPaymentsMethods_id', 'options' => $options['AccountingPaymentMethods']))
                //->add('PurchaseOrderTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.PurchaseOrderTypes_id', 'options' => $options['PurchaseOrderType']))
                ->add('AccountingPhaseCodes', 'select', array('class' => 'form-control', 'ng-model' => 'item.AccountingPhaseCodes_id', 'options' => $options['phase']))

                ->add('description', 'text', array('class' => 'form-control', 'ng-model' => 'item.description'))
                ->add('status', 'text', array('class' => 'form-control', 'ng-model' => 'item.status'))
                ->add('deliveryFee', 'text', array('class' => 'form-control', 'ng-model' => 'item.deliveryFee'))
                ->add('tax', 'text', array('class' => 'form-control', 'ng-model' => 'item.tax'))
                ->add('total', 'text', array('class' => 'form-control', 'ng-model' => 'item.total'))
                
                ->add('id', 'hidden', array('ng-model' => 'item.id'));

        return $builder->getForm();
    }

}
