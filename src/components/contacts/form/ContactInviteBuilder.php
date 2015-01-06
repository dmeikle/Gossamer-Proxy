<?php

namespace components\contacts\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of ContactInviteBuilder
 *
 * @author davem
 */
class ContactInviteBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('ContactInvite', $validationResults)) {
            $builder->addValidationResults($validationResults['ContactInvite']);
        }
              

        $builder->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' => $this->getValue('lastname', $values)))
                ->add('username', 'text', array('class' => 'form-control', 'value' => $this->getValue('username', $values)))
                ->add('password', 'text', array('class' => 'form-control', 'value' => $this->getValue('mobile', $values)))
               // ->add('InviterContacts_id', 'select', array('class' => 'form-control', 'options' => $options['InviterContacts_id']))
                ->add('invitationDate', 'span', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))
               // ->add('InviterStaff_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))    
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('ContactInvites_id', 'span',  array('class' => 'form-control', 'value' => $this->getValue('ContactInvites_id', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));
                
        
        return $builder->getForm();
    }


}
