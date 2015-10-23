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
 * Description of CustomerInviteBuilder
 *
 * @author Dave Meikle
 */
class CustomerInviteBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('CustomerInvite', $validationResults)) {
            $builder->addValidationResults($validationResults['CustomerInvite']);
        }


        $builder->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' => $this->getValue('lastname', $values)))
                ->add('username', 'text', array('class' => 'form-control', 'value' => $this->getValue('username', $values)))
                ->add('password', 'text', array('class' => 'form-control', 'value' => $this->getValue('mobile', $values)))
                // ->add('InviterCustomers_id', 'select', array('class' => 'form-control', 'options' => $options['InviterCustomers_id']))
                ->add('invitationDate', 'span', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))
                // ->add('InviterStaff_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('CustomerInvites_id', 'span', array('class' => 'form-control', 'value' => $this->getValue('CustomerInvites_id', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary cancel'));


        return $builder->getForm();
    }

}
