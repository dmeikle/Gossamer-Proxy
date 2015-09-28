<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * ClientBuilder
 *
 * @author Dave Meikle
 */
class ClientBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Client', $validationResults)) {
            $builder->addValidationResults($validationResults['Client']);
        }
              

        $builder->add('firstname', 'text', array('class' => 'form-control', $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', $this->getValue('lastname', $values)))
                ->add('email', 'email', array('class' => 'form-control', $this->getValue('email', $values)))
                ->add('company', 'text', array('class' => 'form-control', $this->getValue('company', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', $this->getValue('telephone', $values)))
                ->add('address1', 'text', array('class' => 'form-control', $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', $this->getValue('address2', $values)))    
                ->add('city', 'text', array('class' => 'form-control', $this->getValue('city', $values)))
                ->add('state', 'text',  array('class' => 'form-control', $this->getValue('state', $values)))
                ->add('country', 'text',  array('class' => 'form-control', $this->getValue('country', $values)))
                ->add('zip', 'text', array('class' => 'form-control', $this->getValue('zip', $values)))
                ->add('shipFirstname', 'text', array('class' => 'form-control', $this->getValue('shipFirstname', $values)))
                ->add('shipLastname', 'text', array('class' => 'form-control', $this->getValue('shipLastname', $values)))
                ->add('shipEmail', 'email', array('class' => 'form-control', $this->getValue('shipEmail', $values)))
                ->add('shipCompany', 'text', array('class' => 'form-control', $this->getValue('shipCompany', $values)))
                ->add('shipTelephone', 'text', array('class' => 'form-control', $this->getValue('shipTelephone', $values)))
                ->add('shipAddress1', 'text', array('class' => 'form-control', $this->getValue('shipAddress1', $values)))
                ->add('shipAddress2', 'text', array('class' => 'form-control', $this->getValue('shipAddress2', $values)))    
                ->add('shipCity', 'text', array('class' => 'form-control', $this->getValue('shipCity', $values)))
                ->add('shipState', 'text',  array('class' => 'form-control', $this->getValue('shipState', $values)))
                ->add('shipCountry', 'text',  array('class' => 'form-control', $this->getValue('shipCountry', $values)))
                ->add('shipZip', 'text', array('class' => 'form-control', $this->getValue('shipZip', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));
                
        
        return $builder->getForm();
    }

}
