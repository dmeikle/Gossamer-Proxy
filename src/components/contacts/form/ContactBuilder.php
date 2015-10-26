<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author Dave Meikle
 */
class ContactBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Contact', $validationResults)) {
            $builder->addValidationResults($validationResults['Contact']);
        }

        $builder->add('Companies_id', 'select', array('ng-model' => 'contact.Companies_id', 'class' => 'form-control'))
                ->add('ContactTypes_id', 'select', array('ng-model' => 'contact.ContactTypes_id', 'class' => 'form-control', 'options' => $options['contactTypes']))
                ->add('ContactVIPTypes_id', 'select', array('ng-model' => 'contact.ContactVIPTypes_id', 'class' => 'form-control', 'options' => $options['contactVIPTypes']))
                ->add('firstname', 'text', array('ng-model' => 'contact.firstname', 'class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('ng-model' => 'contact.lastname', 'class' => 'form-control', 'value' => $this->getValue('lastname', $values)))
                ->add('email', 'email', array('ng-model' => 'contact.email', 'class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('mobile', 'text', array('ng-model' => 'contact.mobile', 'class' => 'form-control', 'value' => $this->getValue('mobile', $values)))
                ->add('home', 'text', array('ng-model' => 'contact.home', 'class' => 'form-control', 'value' => $this->getValue('home', $values)))
                ->add('office', 'text', array('ng-model' => 'contact.office', 'class' => 'form-control', 'value' => $this->getValue('office', $values)))
                ->add('extension', 'text', array('ng-model' => 'contact.extension', 'class' => 'form-control', 'value' => $this->getValue('extension', $values)))
                ->add('isActive', 'check', array('ng-model' => 'contact.isActive', 'class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('ContactInvites_id', 'text', array('ng-model' => 'contact.ContactInvites_id', 'class' => 'form-control', 'value' => $this->getValue('ContactInvites_id', $values)))
                ->add('notes', 'textarea', array('ng-model' => 'contact.notes', 'class' => 'form-control', 'value' => $this->getValue('notes', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));


        return $builder->getForm();
    }

}
