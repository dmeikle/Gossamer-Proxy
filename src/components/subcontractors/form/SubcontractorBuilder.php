<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\subcontractors\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * SubcontractorBuilder
 *
 * @author Dave Meikle
 */
class SubcontractorBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('SubcontractorBuilder', $validationResults)) {
            $builder->addValidationResults($validationResults['SubcontractorBuilder']);
        }
        if (is_array($values) && array_key_exists('SubcontractorBuilder', $values)) {
            $values = current($values['SubcontractorBuilder']);
        }

        $builder->add('companyName', 'text', array('ng-model' => 'subcontractor.companyName', 'class' => 'form-control', 'value' => $this->getValue('companyName', $values)))
                ->add('address1', 'text', array('ng-model' => 'subcontractor.address1', 'class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-model' => 'subcontractor.address2', 'class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('email', 'text', array('ng-model' => 'subcontractor.email', 'class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('city', 'text', array('ng-model' => 'subcontractor.city', 'class' => 'form-control', 'value' => $this->getValue('city', $values)));


        if (array_key_exists('subcontractorTypes', $options)) {
            $builder->add('CompanyTypes_id', 'select', array('ng-model' => 'subcontractor.CompanyTypes_id', 'class' => 'form-control', 'options' => $options['subcontractorTypes']));
        }
        if (array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-model' => 'subcontractor.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']));
        }
        if (array_key_exists('countries', $options)) {
            $builder->add('Countries_id', 'select', array('ng-model' => 'subcontractor.Countries_id', 'class' => 'form-control', 'options' => $options['countries']));
        }

        $builder->add('postalCode', 'text', array('ng-model' => 'subcontractor.postalCode', 'class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('fax', 'text', array('ng-model' => 'subcontractor.fax', 'class' => 'form-control', 'value' => $this->getValue('fax', $values)))
                ->add('telephone', 'text', array('ng-model' => 'subcontractor.telephone', 'class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('url', 'text', array('ng-model' => 'subcontractor.url', 'class' => 'form-control', 'value' => $this->getValue('url', $values)))
                ->add('isActive', 'text', array('ng-model' => 'subcontractor.isActive', 'class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('subcontractorId', 'hidden', array('ng-model' => 'subcontractor.subcontractorId', 'value' => $this->getValue('id', $values)))
                ->add('id', 'hidden', array('ng-model' => 'subcontractor.id', 'value' => $this->getValue('id', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));

        return $builder->getForm();
    }

}
