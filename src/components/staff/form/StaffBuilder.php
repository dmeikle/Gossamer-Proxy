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
class StaffBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
        if(is_array($values) && array_key_exists('Staff', $values)) {
            $values = current($values['Staff']);
        }

        $builder->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('lastname', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('telephone', $values)))
                ->add('mobile', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('mobile', $values)))
                ->add('email', 'email', array('class' => 'form-control', 'value' =>  $this->getValue('email', $values)))
                ->add('address1', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('postalCode', $values)))  
                ->add('imageName', 'file', array('class' => '', 'value' =>  $this->getValue('imageName', $values)))  
                ->add('title', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('title', $values)))              
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))             
                ->add('Positions_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))            
                ->add('Departments_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))  
                ->add('employeeNumber', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('employeeNumber', $values))) 
                ->add('hireDate', 'text', array('class' => 'form-control datepicker', 'value' =>  $this->getValue('hireDate', $values))) 
                ->add('departureDate', 'text', array('class' => 'form-control datepicker', 'value' =>  $this->getValue('departureDate', $values))) 
                ->add('gender', 'text', array('class' => 'form-control', 'options' =>  $this->getValue('gender', $values))) 
                ->add('dob', 'text', array('class' => 'form-control datepicker', 'value' =>  $this->getValue('dob', $values))) 
                ->add('personalEmail', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('personalEmail', $values))) 
                ->add('SIN', 'text', array('class' => 'form-control datepicker', 'value' =>  $this->getValue('SIN', $values)))
                ->add('alarmPassword', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('alarmPassword', $values)))
                ->add('signature', 'textarea', array('class' => 'form-control', 'value' =>  $this->getValue('signature', $values))) 
                ->add('StaffTypes_id', 'select', array('class' => 'form-control'))   
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'))
                ->add('submit', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'));   
       
                if($this->getValue('isActive', $values) == 1) {
                    $builder->add('isActive', 'check', array('value' => '1', 'checked' => true ));
                } else {
                    $builder->add('isActive', 'check', array('value' => '1'));
                }
                
        return $builder->getForm();
    }


}
