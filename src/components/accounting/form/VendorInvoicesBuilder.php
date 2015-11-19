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
class PurchaseOrderBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('PurchaseOrder', $validationResults)) {
            $builder->addValidationResults($validationResults['PurchaseOrder']);
        }

        $builder->add('invoiceNumber', 'text', array('class' => 'form-control', 'ng-model' => 'item.invoiceNumber'))
                ->add('jobNumber', 'text', array('ng-model' => 'item.jobNumber', 'uib-typeahead' => 'value for value in fetchClaimAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsClaim', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'ng-blur' => 'getClaimsID(item.jobNumber)'))
                ->add('ClaimPhases_id', 'select', array('class' => 'form-control col-md-7', 'ng-model' => 'item.ClaimPhases_id', 'options' => $options['claimPhases']))
                ->add('Departments_id', 'select', array('ng-click' => 'updateTax($event)', 'class' => 'form-control col-md-7', 'ng-model' => 'item.Departments_id', 'options' => $options['departments']))
                ->add('vendorsAutocomplete', 'text', array('ng-model' => 'item.company', 'uib-typeahead' => 'value as value.company for value in fetchVendorsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsVendors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getVendorLocations(item.company);'))
                ->add('subcontractorsAutocomplete', 'text', array('ng-model' => 'item.subcontractor', 'uib-typeahead' => 'value as value.subcontractor for value in fetchSubcontractorsAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsSubcontractors', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getSubcontractorsID(item.subcontractor);'))
                ->add('purchsaeOrdersAutocomplete', 'text', array('ng-model' => 'item.purchaseOrder', 'uib-typeahead' => 'value as value.subcontractor for value in fetchPurchaseOrdersAutocomplete($viewValue)',
                    'typeahead-loading' => 'loadingTypeahead', 'typeahead-no-results' => 'noResultsPurchaseOrders', 'class' => 'form-control typeahead col-md-7',
                    'typeahead-min-length' => '2', 'typeahead-on-select' => 'getSubcontractorsID(item.purchaseOrder);'))
                ->add('description', 'textarea', array('class' => 'form-control col-md-7', 'ng-model' => 'item.description'))
                ->add('tax', 'text', array('class' => 'form-control col-md-6', 'ng-model' => 'item.tax', 'ng-change' => 'updateTotal()'))
                ->add('total', 'text', array('class' => 'form-control', 'ng-model' => 'item.total'));

        return $builder->getForm();
    }

}
