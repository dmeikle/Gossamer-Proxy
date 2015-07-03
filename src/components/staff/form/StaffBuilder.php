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

        $builder->add('firstname', 'text', array('ng-model' => 'staff.firstname', 'class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('id', 'hidden', array('ng-model' => 'staff.id', 'value' =>  $this->getValue('id', $values)))
                ->add('lastname', 'text', array('ng-model' => 'staff.lastname', 'class' => 'form-control', 'value' =>  $this->getValue('lastname', $values)))
                ->add('telephone', 'text', array('ng-model' => 'staff.telephone', 'class' => 'form-control ', 'value' =>  $this->getValue('telephone', $values)))
                ->add('mobile', 'text', array('ng-model' => 'staff.mobile', 'class' => 'form-control ', 'value' =>  $this->getValue('mobile', $values)))
                ->add('email', 'email', array('ng-model' => 'staff.email', 'class' => 'form-control ', 'value' =>  $this->getValue('email', $values)))
                ->add('personalTelephone', 'text', array('ng-model' => 'staff.personalTelephone', 'class' => 'form-control ', 'value' =>  $this->getValue('personalTelephone', $values)))
                ->add('personalMobile', 'text', array('ng-model' => 'staff.personalMobile', 'class' => 'form-control ', 'value' =>  $this->getValue('personalMobile', $values)))
                ->add('personalEmail', 'email', array('ng-model' => 'staff.personalEmail', 'class' => 'form-control ', 'value' =>  $this->getValue('personalEmail', $values)))
                ->add('address1', 'text', array('ng-model' => 'staff.address1', 'class' => 'form-control ', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-model' => 'staff.address2', 'class' => 'form-control ', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('ng-model' => 'staff.city', 'class' => 'form-control ', 'value' =>  $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('ng-model' => 'staff.postalCode', 'class' => 'form-control', 'value' =>  $this->getValue('postalCode', $values)))  
                ->add('imageName', 'file', array('ng-model' => 'staff.imageName', 'class' => '', 'value' =>  $this->getValue('imageName', $values)))  
                ->add('title', 'text', array('ng-model' => 'staff.title', 'class' => 'form-control', 'value' =>  $this->getValue('title', $values)))              
                ->add('Provinces_id', 'select', array('ng-model' => 'staff.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']))             
                ->add('StaffPositions_id', 'select', array('ng-model' => 'staff.StaffPositions_id', 'class' => 'form-control ', 'options' => $options['staffPositions']))            
                ->add('Departments_id', 'select', array('ng-model' => 'staff.Departments_id', 'class' => 'form-control', 'options' => $options['departments']))  
                ->add('employeeNumber', 'text', array('ng-model' => 'staff.employeeNumber', 'class' => 'form-control', 'value' =>  $this->getValue('employeeNumber', $values))) 
                ->add('hireDate', 'text', array('ng-model' => 'staff.hireDate', 'class' => 'form-control datepicker ', 'value' =>  $this->getValue('hireDate', $values))) 
                ->add('departureDate', 'text', array('ng-model' => 'staff.departureDate', 'class' => 'form-control datepicker', 'value' =>  $this->getValue('departureDate', $values))) 
                ->add('gender', 'text', array('ng-model' => 'staff.gender', 'class' => 'form-control ', 'options' =>  $this->getValue('gender', $values))) 
                ->add('dob', 'text', array('ng-model' => 'staff.dob', 'class' => 'form-control datepicker ', 'value' =>  $this->getValue('dob', $values))) 
                ->add('personalEmail', 'text', array('ng-model' => 'staff.personalEmail', 'class' => 'form-control ', 'value' =>  $this->getValue('personalEmail', $values))) 
                ->add('SIN', 'text', array('ng-model' => 'staff.SIN', 'class' => 'form-control datepicker', 'value' =>  $this->getValue('SIN', $values)))
                ->add('alarmPassword', 'text', array('ng-model' => 'staff.alarmPassword', 'class' => 'form-control ', 'value' =>  $this->getValue('alarmPassword', $values)))
                ->add('signature', 'textarea', array('ng-model' => 'staff.signature', 'class' => 'form-control ', 'value' =>  $this->getValue('signature', $values))) 
                ->add('StaffTypes_id', 'select', array('ng-model' => 'staff.StaffTypes_id', 'class' => 'form-control', 'options' => $options['staffTypes'])) 
                ->add('extension', 'text', array('ng-model' => 'staff.extension', 'class' => 'form-control', 'value' => $this->getValue('extension', $values))) 
                ->add('cancel', 'button', array('value' => 'Cancel', 'class' => 'btn btn-primary cancel-staff'))
                ->add('submit', 'button', array('value' => 'Save', 'class' => 'btn btn-primary save-staff')) 
                ->add('savePersonal', 'button', array('value' => 'Next', 'class' => 'btn btn-primary save-staff', 'ng-click' => 'savePersonal(staff)')) 
                ->add('saveEmployment', 'button', array('value' => 'Next', 'class' => 'btn btn-primary save-staff', 'ng-click' => 'saveEmployment(staff)'))
                ->add('saveRoles', 'button', array('value' => 'Next', 'class' => 'btn btn-primary save-staff', 'ng-click' => 'saveRoles(staff)'));   
       
                if($this->getValue('isActive', $values) == 1) {
                    $builder->add('isActive', 'check', array('value' => '1', 'checked' => true ));
                } else {
                    $builder->add('isActive', 'check', array('value' => '1'));
                }
                
        return $builder->getForm();
    }


}
