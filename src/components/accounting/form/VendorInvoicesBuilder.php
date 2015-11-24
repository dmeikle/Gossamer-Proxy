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
 * Vendor Invoices Builder
 *
 * @author Dave Meikle
 */
class VendorInvoicesBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('VendorInvoice', $validationResults)) {
            $builder->addValidationResults($validationResults['VendorInvoice']);
        }
        //
        $builder->add('invoiceNumber', 'text', array('class' => 'form-control col-md-7', 'ng-model' => 'item.invoiceNumber'))
                ->add('jobNumber', 'text', array('ng-model' => 'item.jobNumber', 'uib-typeahead' => 'value as value.jobNumber for value in fetchClaimAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsClaim', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getClaimsID(item.jobNumber)', 'autocomplete' => 'off', 'typeahead-wait-ms' => '500'))
                ->add('ClaimPhases_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.ClaimPhases_id', 'options' => $options['claimPhases']))
                ->add('Departments_id', 'select', array('ng-click' => 'updateTax($event)', 'class' => 'form-control col-md-7', 'ng-model' => 'item.Departments_id', 'options' => $options['departments']))
                ->add('vendorsAutocomplete', 'text', array('ng-model' => 'item.vendor', 'uib-typeahead' => "value as value.company + ' ' + value.city for value in fetchVendorsAutocomplete(\$viewValue)",
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsVendors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getVendorsID(item.vendor);', 'typeahead-wait-ms' => '500'))
                ->add('subcontractorsAutocomplete', 'text', array('ng-model' => 'item.subcontractor', 'uib-typeahead' => 'value as value.companyName for value in fetchSubcontractorsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsSubcontractors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getSubcontractorsID(item.subcontractor);', 'typeahead-wait-ms' => '500'))
                ->add('purchaseOrdersAutocomplete', 'text', array('ng-model' => 'item.purchaseOrder', 'uib-typeahead' => 'value as value.subcontractor for value in fetchPurchaseOrdersAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsPurchaseOrders', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getSubcontractorsID(item.purchaseOrder);', 'typeahead-wait-ms' => '500'))
                ->add('description', 'textarea', array('class' => 'form-control col-md-7', 'ng-model' => 'item.description'))
                ->add('deliveryFee', 'text', array('class' => 'form-control col-md-6', 'ng-model' => 'item.deliveryFee', 'ng-change' => 'updateTotal()'))
                ->add('tax', 'text', array('class' => 'form-control col-md-6', 'ng-model' => 'item.tax', 'ng-change' => 'updateTotal()'))
                ->add('total', 'text', array('class' => 'form-control', 'ng-model' => 'item.total'))
                ->add('AccountingPaymentMethods_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.AccountingPaymentMethods_id', 'options' => $options['AccountingPaymentMethods']))

                //Line Items
                //->add('isSelected', 'checkbox', array('class' => 'form-control', 'ng-model' => 'row.isSelected', 'value' => '123'))
                ->add('staffName', 'text', array('ng-model' => 'row.staff', 'uib-typeahead' => "value as value.firstname + ' ' + value.lastname for value in fetchStaffAutocomplete(\$viewValue)",
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsClaim', 'class' => 'form-control typeahead',
                    'typeahead-min-length' => '3', 'typeahead-on-select' => 'getStaffID(row, row.staff)', 'autocomplete' => 'off', 'typeahead-wait-ms' => '500'))
                ->add('productCode', 'text', array('ng-model' => 'row.productCode', 'uib-typeahead' => 'value as value.productCode for value in fetchProductCodeAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsProductCode', 'class' => 'form-control typeahead',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getProductInfo(row, row.productCode, $index);', 'typeahead-wait-ms' => '500'))
                ->add('productName', 'text', array('ng-model' => 'row.name', 'uib-typeahead' => 'value as value.name for value in fetchProductNameAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsProductName', 'class' => 'form-control typeahead',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getProductInfo(row, row.name, $index);', 'typeahead-wait-ms' => '500'))
                ->add('productDescription', 'text', array('class' => 'form-control', 'ng-model' => 'row.description'))
                ->add('taxPercent', 'text', array('class' => 'form-control', 'ng-model' => 'row.taxPercent', 'ng-change' => 'updateAmount(row)'))
                ->add('taxType', 'select', array('id' => 'taxType{{$index}}', 'class' => 'form-control', 'ng-change' => 'updateTaxList(row, $index, row.AccountingTaxTypes_id);updateAmount(row)', 'ng-init' => 'updateTax(row, $index, row.AccountingTaxTypes_id);', 'ng-model' => 'row.AccountingTaxTypes_id', 'options' => $options['taxTypes']))
                //->add('taxAmount', 'text', array('class' => 'form-control', 'ng-model' => 'row.tax', 'ng-change'=>'updateAmount(row)'))
                ->add('unitPrice', 'text', array('class' => 'form-control', 'ng-model' => 'row.price', 'ng-change' => 'updateAmount(row)'))
                ->add('quantity', 'text', array('class' => 'form-control', 'ng-model' => 'row.quantity', 'ng-change' => 'updateAmount(row)'));
        return $builder->getForm();
    }

}
