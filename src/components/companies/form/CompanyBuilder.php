<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\companies\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * CompanyBuilder
 *
 * @author Dave Meikle
 */
class CompanyBuilder extends AbstractBuilder {
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Company', $validationResults)) {
            $builder->addValidationResults($validationResults['Company']);
        }
        if(is_array($values) && array_key_exists('Company', $values)) {
            $values = current($values['Company']);
        }

        $builder->add('name', 'text', array('ng-init' => "company.name = '" . $this->getValue('name', $values) . "'", 'ng-model' => 'company.name', 'class' => 'form-control', 'value' =>  $this->getValue('name', $values)))
                ->add('address1', 'text', array('ng-init' => "company.address1 = '" . $this->getValue('address1', $values) . "'",'ng-model' => 'company.address1', 'class' => 'form-control', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-init' => "company.address2 = '" . $this->getValue('address2', $values) . "'",'ng-model' => 'company.address2', 'class' => 'form-control', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('ng-init' => "company.city = '" . $this->getValue('city', $values) . "'",'ng-model' => 'company.city', 'class' => 'form-control', 'value' =>  $this->getValue('city', $values)));
        
                
        if (array_key_exists('companyTypes', $options)) {
            $builder->add('CompanyTypes_id', 'select', array('ng-init' => "company.CompanyTypes_id = '" . $this->getValue('CompanyTypes_id', $values) . "'",'ng-model' => 'company.CompanyTypes_id', 'class' => 'form-control', 'options' => $options['companyTypes']));
        }
        if (array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-init' => "company.Provinces_id = '" . $this->getValue('Provinces_id', $values) . "'",'ng-model' => 'company.Provinces_id', 'class' => 'form-control', 'options' =>  $options['provinces']));
        }
        if (array_key_exists('countries', $options)) {
            $builder->add('Countries_id', 'select', array('ng-init' => "company.Countries_id = '" . $this->getValue('Countries_id', $values) . "'",'ng-model' => 'company.Countries_id', 'class' => 'form-control', 'options' =>  $options['countries']));
        }
        
        $builder->add('postalCode', 'text', array('ng-init' => "company.name = '" . $this->getValue('name', $values) . "'",'ng-model' => 'company.postalCode', 'class' => 'form-control', 'value' =>  $this->getValue('postalCode', $values)))
                ->add('fax', 'text', array('ng-init' => "company.fax = '" . $this->getValue('fax', $values) . "'",'ng-model' => 'company.fax', 'class' => 'form-control', 'value' =>  $this->getValue('fax', $values)))
                ->add('telephone', 'text', array('ng-init' => "company.telephone = '" . $this->getValue('telephone', $values) . "'",'ng-model' => 'company.telephone', 'class' => 'form-control', 'value' =>  $this->getValue('telephone', $values)))
                ->add('url', 'text', array('ng-init' => "company.url = '" . $this->getValue('url', $values) . "'",'ng-model' => 'company.url', 'class' => 'form-control', 'value' =>  $this->getValue('url', $values)))
                ->add('isActive', 'text', array('ng-init' => "company.isActive = '" . $this->getValue('isActive', $values) . "'",'ng-model' => 'company.isActive', 'class' => 'form-control', 'value' =>  $this->getValue('isActive', $values)))
                ->add('companyId', 'hidden', array('ng-init' => "company.companyId = '" . $this->getValue('id', $values) . "'", 'ng-model' => 'company.companyId', 'value' => $this->getValue('id', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));
        
        return $builder->getForm();                
    }

}
