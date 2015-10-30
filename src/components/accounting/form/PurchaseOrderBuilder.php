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

        $builder->add('Vendors_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.Vendors_id', 'options' => $options['vendors']))
                ->add('Departments_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.Departments_id', 'options' => $options['departments']))
                ->add('AccountingPaymentsMethods_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.AccountingPaymentsMethods_id', 'options' => $options['AccountingPaymentMethods']))
                //->add('PurchaseOrderTypes_id', 'select', array('class' => 'form-control', 'ng-model' => 'item.PurchaseOrderTypes_id', 'options' => $options['PurchaseOrderType']))
                ->add('basicSearch', 'text', array('ng-model' => 'item.Claims_id', 'typeahead'=>'value for value in fetchClaimAutocomplete($viewValue)',
               'typeahead-loading'=>'loadingTypeahead', 'typeahead-no-results'=>'noResultsClaim', 'class'=>'form-control typeahead col-md-7',
               'typeahead-min-length'=>'2', 'ng-blur'=>'getClaimsID(item.jobNumber)'))
                ->add('AccountingPhaseCodes', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.AccountingPhaseCodes_id', 'options' => $options['phase']))
                ->add('description', 'textarea', array('class' => 'form-control', 'ng-model' => 'item.description'))
                
                //Line Items
                //->add('isSelected', 'checkbox', array('class' => 'form-control', 'ng-model' => 'row.isSelected', 'value' => '123'))
                ->add('productCode', 'text', array('ng-model' => 'row.productCode', 'typeahead'=>'value for value in fetchProductCodeAutocomplete($viewValue)',
               'typeahead-loading'=>'loadingTypeahead', 'typeahead-no-results'=>'noResultsProductCode', 'class'=>'form-control typeahead',
               'typeahead-min-length'=>'2', 'ng-blur'=>'getProductCodeInfo(row, row.productCode);updateAmount(row)'))
                ->add('productName', 'text', array('ng-model' => 'row.productName', 'typeahead'=>'value for value in fetchProductNameAutocomplete($viewValue)',
               'typeahead-loading'=>'loadingTypeahead', 'typeahead-no-results'=>'noResultsProductName', 'class'=>'form-control typeahead',
               'typeahead-min-length'=>'2', 'ng-blur'=>'getProductNameInfo(row, row.productName);updateAmount(row)'))
                ->add('productDescription', 'text', array('class' => 'form-control', 'ng-model' => 'row.description'))
                ->add('taxPercent', 'text', array('class' => 'form-control', 'ng-model' => 'row.taxPercent', 'ng-change'=>'updateTotal()'))
                ->add('taxAmount', 'text', array('class' => 'form-control', 'ng-model' => 'item.taxAmount', 'ng-change'=>'updateTotal()'))
                ->add('productPrice', 'text', array('class' => 'form-control', 'ng-model' => 'row.price', 'ng-change'=>'updateAmount(row)'))
                ->add('productQuantity', 'text', array('class' => 'form-control', 'ng-model' => 'row.quantity', 'ng-change'=>'updateAmount(row)'))
                //Totals
                ->add('status', 'text', array('class' => 'form-control', 'ng-model' => 'item.status', 'value' => '123'))
                ->add('deliveryFee', 'text', array('class' => 'form-control col-md-6', 'ng-model' => 'item.deliveryFee', 'ng-change'=>'updateTotal()'))
                ->add('tax', 'text', array('class' => 'form-control col-md-6', 'ng-model' => 'item.tax', 'ng-change'=>'updateTotal()'))
                ->add('total', 'text', array('class' => 'form-control', 'ng-model' => 'item.total'))
                ->add('id', 'hidden', array('ng-model' => 'item.id'));

        return $builder->getForm();
    }

}
