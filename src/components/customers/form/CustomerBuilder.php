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
class CustomerBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Customer', $validationResults)) {
            $builder->addValidationResults($validationResults['Customer']);
        }


        $builder->add('Companies_id', 'select', array('class' => 'form-control'))
                ->add('CustomerTypes_id', 'select', array('class' => 'form-control', 'options' => $options['contactTypes']))
                ->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' => $this->getValue('lastname', $values)))
                ->add('email', 'email', array('class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('mobile', 'text', array('class' => 'form-control', 'value' => $this->getValue('mobile', $values)))
                ->add('home', 'text', array('class' => 'form-control', 'value' => $this->getValue('home', $values)))
                ->add('office', 'text', array('class' => 'form-control', 'value' => $this->getValue('office', $values)))
                ->add('extension', 'text', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('CustomerInvites_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('CustomerInvites_id', $values)))
                ->add('notes', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('notes', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));


        return $builder->getForm();
    }

}
