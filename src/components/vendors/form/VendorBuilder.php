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
 * VendorBuilder
 *
 * @author Dave Meikle
 */
class VendorBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Company', $validationResults)) {
            $builder->addValidationResults($validationResults['Company']);
        }
        if (is_array($values) && array_key_exists('Company', $values)) {
            $values = current($values['Company']);
        }

        $builder->add('company', 'text', array('ng-init' => "vendor.name = '" . $this->getValue('name', $values) . "'", 'ng-model' => 'vendor.company', 'class' => 'form-control', 'value' => $this->getValue('company', $values)))
                ->add('address1', 'text', array('ng-init' => "vendor.address1 = '" . $this->getValue('address1', $values) . "'", 'ng-model' => 'vendor.address1', 'class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-init' => "vendor.address2 = '" . $this->getValue('address2', $values) . "'", 'ng-model' => 'vendor.address2', 'class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('city', 'text', array('ng-init' => "vendor.city = '" . $this->getValue('city', $values) . "'", 'ng-model' => 'vendor.city', 'class' => 'form-control', 'value' => $this->getValue('city', $values)))
                ->add('accountId', 'text', array('ng-init' => "vendor.accountId = '" . $this->getValue('accountId', $values) . "'", 'ng-model' => 'vendor.accountId', 'class' => 'form-control', 'value' => $this->getValue('accountId', $values)))
                ->add('accountId', 'text', array('ng-init' => "vendor.salesRep = '" . $this->getValue('salesRep', $values) . "'", 'ng-model' => 'vendor.salesRep', 'class' => 'form-control', 'value' => $this->getValue('salesRep', $values)))
                ->add('id', 'hidden', array('ng-init' => "vendor.id = '" . $this->getValue('id', $values) . "'", 'ng-model' => 'vendor.id', 'class' => 'form-control', 'value' => $this->getValue('id', $values)))
                ->add('deliveryFee', 'text', array('ng-init' => "vendor.deliveryFee = '" . $this->getValue('city', $values) . "'", 'ng-model' => 'vendor.deliveryFee', 'class' => 'form-control', 'value' => $this->getValue('deliveryFee', $values)));

        if (array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-init' => "vendor.Provinces_id = '" . $this->getValue('Provinces_id', $values) . "'", 'ng-model' => 'vendor.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']));
        }
        if (array_key_exists('countries', $options)) {
            $builder->add('Countries_id', 'select', array('ng-init' => "vendor.Countries_id = '" . $this->getValue('Countries_id', $values) . "'", 'ng-model' => 'vendor.Countries_id', 'class' => 'form-control', 'options' => $options['countries']));
        }

        $builder->add('postalCode', 'text', array('ng-init' => "vendor.name = '" . $this->getValue('name', $values) . "'", 'ng-model' => 'vendor.postalCode', 'class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('fax', 'text', array('ng-init' => "vendor.fax = '" . $this->getValue('fax', $values) . "'", 'ng-model' => 'vendor.fax', 'class' => 'form-control', 'value' => $this->getValue('fax', $values)))
                ->add('telephone', 'text', array('ng-init' => "vendor.telephone = '" . $this->getValue('telephone', $values) . "'", 'ng-model' => 'vendor.telephone', 'class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('url', 'text', array('ng-init' => "vendor.url = '" . $this->getValue('url', $values) . "'", 'ng-model' => 'vendor.url', 'class' => 'form-control', 'value' => $this->getValue('url', $values)))
                ->add('tollFree', 'text', array('ng-init' => "vendor.tollFree = '" . $this->getValue('tollFree', $values) . "'", 'ng-model' => 'vendor.tollFree', 'class' => 'form-control', 'value' => $this->getValue('tollFree', $values)))
                ->add('email', 'text', array('ng-init' => "vendor.email = '" . $this->getValue('email', $values) . "'", 'ng-model' => 'vendor.email', 'class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('isActive', 'text', array('ng-init' => "vendor.isActive = '" . $this->getValue('isActive', $values) . "'", 'ng-model' => 'vendor.isActive', 'class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('companyId', 'hidden', array('ng-init' => "vendor.companyId = '" . $this->getValue('id', $values) . "'", 'ng-model' => 'vendor.companyId', 'value' => $this->getValue('id', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));

        return $builder->getForm();
    }

}
