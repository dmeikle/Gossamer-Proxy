<?php

namespace components\staff\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author davem
 */
class StaffBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        $builder->addValidationResults($validationResults['Staff']);
      
        $builder->add('firstname', 'text', array('class' => 'form-control', $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', $this->getValue('lastname', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', $this->getValue('firstname', $values)))
                ->add('email', 'email', array('class' => 'form-control', $this->getValue('email', $values)))
                ->add('address1', 'text', array('class' => 'form-control', $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', $this->getValue('address2', $values)))
                ->add('city', 'text', array('class' => 'form-control', $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control', $this->getValue('postalCode', $values)))
                ->add('username', 'text', array('class' => 'form-control', $this->getValue('username', $values)))
                ->add('password', 'password', array('class' => 'form-control'))
                ->add('passwordConfirm', 'password', array('class' => 'form-control'))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }


}
