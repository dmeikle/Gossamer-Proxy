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

        $builder->add('firstname', 'text', array('ng-model' => 'user.firstname', 'class' => 'form-control wizard-stage-1-firstname', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('ng-model' => 'user.lastname', 'class' => 'form-control form-control wizard-stage-1-lastname', 'value' =>  $this->getValue('lastname', $values)))
                ->add('telephone', 'text', array('class' => 'form-control form-control wizard-stage-1-telephone', 'value' =>  $this->getValue('telephone', $values)))
                ->add('mobile', 'text', array('class' => 'form-control form-control wizard-stage-1-mobile', 'value' =>  $this->getValue('mobile', $values)))
                ->add('email', 'email', array('class' => 'form-control form-control wizard-stage-1-email', 'value' =>  $this->getValue('email', $values)))
                ->add('address1', 'text', array('class' => 'form-control form-control wizard-stage-1-address1', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control form-control wizard-stage-1-address2', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('class' => 'form-control form-control wizard-stage-1-city', 'value' =>  $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control wizard-stage-1-postalCode', 'value' =>  $this->getValue('postalCode', $values)))  
                ->add('imageName', 'file', array('class' => '', 'value' =>  $this->getValue('imageName', $values)))  
                ->add('title', 'text', array('class' => 'form-control wizard-stage-1-title', 'value' =>  $this->getValue('title', $values)))              
                ->add('Provinces_id', 'select', array('class' => 'form-control wizard-stage-1-Provinces_id', 'options' => $options['provinces']))             
                ->add('StaffPositions_id', 'select', array('class' => 'form-control wizard-stage-1-StaffPositions_id', 'options' => $options['staffPositions']))            
                ->add('Departments_id', 'select', array('class' => 'form-control', 'options' => $options['departments']))  
                ->add('employeeNumber', 'text', array('class' => 'form-control wizard-stage-1-employeeNumber', 'value' =>  $this->getValue('employeeNumber', $values))) 
                ->add('hireDate', 'text', array('class' => 'form-control datepicker wizard-stage-1-hireDate', 'value' =>  $this->getValue('hireDate', $values))) 
                ->add('departureDate', 'text', array('class' => 'form-control datepicker', 'value' =>  $this->getValue('departureDate', $values))) 
                ->add('gender', 'text', array('class' => 'form-control wizard-stage-1-gender', 'options' =>  $this->getValue('gender', $values))) 
                ->add('dob', 'text', array('class' => 'form-control datepicker wizard-stage-1-dob', 'value' =>  $this->getValue('dob', $values))) 
                ->add('personalEmail', 'text', array('class' => 'form-control wizard-stage-1-personalEmail', 'value' =>  $this->getValue('personalEmail', $values))) 
                ->add('SIN', 'text', array('class' => 'form-control datepicker wizard-stage-1-SIN', 'value' =>  $this->getValue('SIN', $values)))
                ->add('alarmPassword', 'text', array('class' => 'form-control wizard-stage-1-alarmPassword', 'value' =>  $this->getValue('alarmPassword', $values)))
                ->add('signature', 'textarea', array('class' => 'form-control wizard-stage-1-signature', 'value' =>  $this->getValue('signature', $values))) 
                ->add('StaffTypes_id', 'select', array('class' => 'form-control'))   
                ->add('cancel', 'button', array('value' => 'Cancel', 'class' => 'btn btn-primary cancel-staff'))
                ->add('submit', 'button', array('value' => 'Save', 'class' => 'btn btn-primary save-staff'));   
       
                if($this->getValue('isActive', $values) == 1) {
                    $builder->add('isActive', 'check', array('value' => '1', 'checked' => true ));
                } else {
                    $builder->add('isActive', 'check', array('value' => '1'));
                }
                
        return $builder->getForm();
    }


}
