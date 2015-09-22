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

        $builder->add('name', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('name', $values)))
                ->add('CompanyTypes_id', 'select', array('class' => 'form-control', 'options' => $options['companyTypes']))
                ->add('address1', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('city', $values)))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' =>  $options['provinces']))
                ->add('Countries_id', 'select', array('class' => 'form-control', 'options' =>  $options['countries']))
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('postalCode', $values)))
                ->add('fax', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('fax', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('telephone', $values)))
                ->add('url', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('url', $values)))
                ->add('isActive', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('isActive', $values)))
                ->add('companyId', 'hidden', array('value' => $this->getValue('id', $values)))
                ->add('cancel', 'button', array('class' => '', 'value' => 'Cancel'))
                ->add('save', 'button', array('class' => '', 'value' => 'Save'));
        
        return $builder->getForm();                
    }

}
