<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\vendors\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * VendorSearchBuilder
 *
 * @author Dave Meikle
 */
class VendorSearchBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Company', $validationResults)) {
            $builder->addValidationResults($validationResults['Company']);
        }
        if (is_array($values) && array_key_exists('Company', $values)) {
            $values = current($values['Company']);
        }

        $builder->add('company', 'text', array('ng-model' => 'advancedSearch.vendor.company', 'class' => 'form-control', 'value' => $this->getValue('company', $values)))
                ->add('address1', 'text', array('ng-model' => 'advancedSearch.vendor.address1', 'class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-model' => 'advancedSearch.vendor.address2', 'class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('city', 'text', array('ng-model' => 'advancedSearch.vendor.city', 'class' => 'form-control', 'value' => $this->getValue('city', $values)))
                ->add('accountId', 'text', array('ng-model' => 'advancedSearch.vendor.accountId', 'class' => 'form-control', 'value' => $this->getValue('accountId', $values)))
                ->add('salesRep', 'text', array('ng-model' => 'advancedSearch.vendor.salesRep', 'class' => 'form-control', 'value' => $this->getValue('salesRep', $values)))
                ->add('id', 'hidden', array('ng-model' => 'advancedSearch.vendor.id', 'class' => 'form-control', 'value' => $this->getValue('id', $values)))
                ->add('deliveryFee', 'text', array('ng-model' => 'advancedSearch.vendor.deliveryFee', 'class' => 'form-control', 'value' => $this->getValue('deliveryFee', $values)));

        if (array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-model' => 'advancedSearch.vendor.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']));
        }
        if (array_key_exists('countries', $options)) {
            $builder->add('Countries_id', 'select', array('ng-model' => 'advancedSearch.vendor.Countries_id', 'class' => 'form-control', 'options' => $options['countries']));
        }

        $builder->add('postalCode', 'text', array('ng-model' => 'advancedSearch.vendor.postalCode', 'class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('fax', 'text', array('ng-model' => 'advancedSearch.vendor.fax', 'class' => 'form-control', 'value' => $this->getValue('fax', $values)))
                ->add('telephone', 'text', array('ng-model' => 'advancedSearch.vendor.telephone', 'class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('url', 'text', array('ng-model' => 'advancedSearch.vendor.url', 'class' => 'form-control', 'value' => $this->getValue('url', $values)))
                ->add('tollFree', 'text', array('ng-model' => 'advancedSearch.vendor.tollFree', 'class' => 'form-control', 'value' => $this->getValue('tollFree', $values)))
                ->add('email', 'text', array('ng-model' => 'advancedSearch.vendor.email', 'class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('isActive', 'text', array('ng-model' => 'advancedSearch.vendor.isActive', 'class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('companyId', 'hidden', array('ng-model' => 'advancedSearch.vendor.companyId', 'value' => $this->getValue('id', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));

        return $builder->getForm();
    }

}
