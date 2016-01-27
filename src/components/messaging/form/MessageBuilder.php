<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * MessageBuilder
 *
 * @author Dave Meikle
 */
class MessageBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        $builder->add('toStaff_id', 'hidden', array('ng-model' => 'ctrl.message.toStaff_id'))
                ->add('toStaff', 'text', array('class' => 'form-control'))
                ->add('toContact_id', 'hidden', array('ng-model' => 'ctrl.message.toContact_id'))
                ->add('toContact', 'text', array('class' => 'form-control'))
                ->add('subject', 'text', array('class' => 'form-control', 'ng-model' => 'ctrl.message.subject'))
                ->add('MessagingDiscussions_id', 'hidden', array('ng-model' => 'ctrl.message.MessagingDiscussions_id', 'value' => $this->getValue('MessagingDiscussions_id', $values)))
                ->add('reply', 'textarea', array('class' => 'form-control', 'rows' => '8', 'value' => '', 'ng-model' => 'ctrl.message.message'))
                ->add('uniqueId', 'hidden', array('value' => $this->getValue('uniqueId', $values), 'ng-model' => 'ctrl.message.uniqueId'))
                ->add('message', 'textarea', array('class' => 'form-control', 'rows' => '20', 'value' => '', 'ng-model' => 'ctrl.message.message'))
                ->add('discard', 'button', array('class' => 'btn btn-danger btn-sm', 'value' => 'Discard'));

        if (array_key_exists('messageTypes', $options)) {
            $builder->add('MessageTypes_id', 'select', array('class' => 'form-control', 'options' => $options['messageTypes'], 'ng-model' => 'ctrl.message.MessageTypes_id'));
        }

        return $builder->getForm();
    }

}
