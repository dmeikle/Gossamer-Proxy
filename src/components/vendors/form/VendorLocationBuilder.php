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
class VendorLocationBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Company', $validationResults)) {
            $builder->addValidationResults($validationResults['Company']);
        }
        if (is_array($values) && array_key_exists('Company', $values)) {
            $values = current($values['Company']);
        }

        $builder->add('address1', 'text', array('ng-model' => 'vendorLocation.address1', 'class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-model' => 'vendorLocation.address2', 'class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('city', 'text', array('ng-model' => 'vendorLocation.city', 'class' => 'form-control', 'value' => $this->getValue('city', $values)))
                ->add('accountId', 'text', array('ng-model' => 'vendorLocation.accountId', 'class' => 'form-control', 'value' => $this->getValue('accountId', $values)))
                ->add('Vendors_id', 'select', array('ng-model' => 'vendorLocation.Vendors_id', 'class' => 'form-control', 'options' => $options['vendors']))
                ->add('salesRep', 'text', array('ng-model' => 'vendorLocation.salesRep', 'class' => 'form-control', 'value' => $this->getValue('salesRep', $values)));

        if (array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-model' => 'vendorLocation.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']));
        }
        if (array_key_exists('countries', $options)) {
            $builder->add('Countries_id', 'select', array('ng-model' => 'vendorLocation.Countries_id', 'class' => 'form-control', 'options' => $options['countries']));
        }

        $builder->add('postalCode', 'text', array('ng-model' => 'vendorLocation.postalCode', 'class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('telephone', 'text', array('ng-model' => 'vendorLocation.telephone', 'class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('email', 'text', array('ng-model' => 'vendorLocation.email', 'class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));

        return $builder->getForm();
    }

}
