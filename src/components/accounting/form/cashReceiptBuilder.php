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
 * Cashe Receipt Builder
 *
 * @author Devin Cook
 */
class CashReceiptBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        //pr($options);
        if (is_array($validationResults) && array_key_exists('PurchaseOrder', $validationResults)) {
            $builder->addValidationResults($validationResults['PurchaseOrder']);
        }

        $builder->add('DebitAccounts_id', 'select', array('class' => 'form-control col-md-12', 'ng-model' => 'item.AccountingDebitAccounts_id', 'options' => $options['debitAccounts']))
                ->add('CreditAccounts_id', 'select', array('class' => 'form-control col-md-12', 'ng-model' => 'item.AccountingCreditAccounts_id', 'options' => $options['creditAccounts']))
                ->add('companiesAutocomplete', 'text', array('ng-model' => 'company', 'typeahead' => 'value as value.name for value in fetchCompanyAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsCompany', 'class' => 'form-control typeahead col-md-12',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getCompanyID(company)', 'typeahead-wait-ms' => '500'))
                ->add('invoicesAutocomplete', 'text', array('ng-model' => 'item.invoice', 'typeahead' => 'value as value.name for value in fetchInvoiceAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsVendors', 'class' => 'form-control typeahead col-md-12',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getCompanyID(item.company)', 'typeahead-wait-ms' => '500'))
                ->add('jobNumber', 'text', array('ng-model' => 'claim', 'typeahead' => 'value as value.jobNumber for value in fetchClaimsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsClaim', 'class' => 'form-control typeahead col-md-12',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getClaimsID(claim)', 'typeahead-wait-ms' => '500'))
                ->add('ClaimPhases_id', 'select', array('class' => 'form-control col-md-12', 'ng-model' => 'item.ClaimPhases_id', 'options' => $options['claimPhases']))
                ->add('receiptType', 'select', array('class' => 'form-control col-md-12', 'ng-model' => 'item.receiptType', 'options' => $options['claimPhases']))
                ->add('AccountingPaymentMethods_id', 'select', array('class' => 'form-control col-md-12', 'ng-model' => 'item.AccountingPaymentMethods_id', 'options' => $options['paymentMethods']))
                ->add('description', 'textarea', array('class' => 'form-control col-md-12', 'ng-model' => 'item.description'))
                ->add('amount', 'text', array('class' => 'form-control col-md-12', 'ng-model' => 'item.amount'))
                ->add('outstandingAmount', 'text', array('class' => 'form-control col-md-12', 'ng-model' => 'item.outstandingAmount'))
                ->add('chequeNumber', 'text', array('class' => 'form-control col-md-12', 'ng-model' => 'item.chequeNumber'));

        return $builder->getForm();
    }

}
