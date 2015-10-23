<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author Dave Meikle
 */
class CustomerAuthorizationBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Customer', $validationResults)) {
            $builder->addValidationResults($validationResults['Customer']);
        }

        $builder->add('Companies_id', 'select', array('class' => 'form-control'))
                ->add('CustomerTypes_id', 'select', array('class' => 'form-control'))
                ->add('firstname', 'text', array('class' => 'form-control', $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', $this->getValue('lastname', $values)))
                ->add('email', 'email', array('class' => 'form-control', $this->getValue('email', $values)))
                ->add('mobile', 'text', array('class' => 'form-control', $this->getValue('mobile', $values)))
                ->add('home', 'text', array('class' => 'form-control', $this->getValue('home', $values)))
                ->add('office', 'text', array('class' => 'form-control'))
                ->add('extension', 'text', array('class' => 'form-control', $this->getValue('extension', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', $this->getValue('isActive', $values)))
                ->add('CustomerInvites_id', 'text', array('class' => 'form-control', $this->getValue('CustomerInvites_id', $values)))
                ->add('notes', 'textarea', array('class' => 'form-control', $this->getValue('notes', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));

        return $builder->getForm();
    }

    public function buildCredentialsForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('CustomerAuthorization', $validationResults)) {
            $builder->addValidationResults($validationResults['CustomerAuthorization']);
        }

        $builder->add('username', 'text', array('class' => 'form-control', $this->getValue('username', $values)))
                ->add('password', 'password', array('class' => 'form-control', $this->getValue('username', $values)))
                ->add('passwordConfirm', 'password', array('class' => 'form-control'))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));

        return $builder->getForm();
    }

}
