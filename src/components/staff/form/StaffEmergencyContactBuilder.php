<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author Dave Meikle
 */
class StaffEmergencyContactBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('StaffEmergencyContact', $validationResults)) {
            $builder->addValidationResults($validationResults['StaffEmergencyContact']);
        }
        if(is_array($values) && array_key_exists('Staff', $values)) {
            $values = current($values['StaffEmergencyContact']);
        }

        $builder->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('lastname', $values)))
                ->add('workTelephone', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('workTelephone', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('telephone', $values)))
                ->add('mobile', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('mobile', $values)))
                ->add('email', 'email', array('class' => 'form-control', 'value' =>  $this->getValue('email', $values)))
                ->add('relation', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('relation', $values)))
                ->add('submit', 'submit', array('value' => 'Add +', 'class' => 'btn btn-lg btn-primary'))  
                ->add('cancel', 'cancel', array('value' => 'Cancel -', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }


}
