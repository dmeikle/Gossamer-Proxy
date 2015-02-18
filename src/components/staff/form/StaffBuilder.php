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
                ->add('email', 'email', array('class' => 'form-control', 'value' =>  $this->getValue('email', $values)))
                ->add('address1', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('address2', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' =>  $this->getValue('postalCode', $values)))
                //->add('username', 'text', array('class' => 'form-control', $this->getValue('username', $values)))
               // ->add('password', 'password', array('class' => 'form-control'))
               // ->add('passwordConfirm', 'password', array('class' => 'form-control'))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }


}
