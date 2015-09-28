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
        
        $builder->add('toStaff_id', 'hidden', array('ng-model' => 'message.toStaff_id'))
                ->add('toStaff', 'text', array('class' => 'form-control'))
                ->add('toContact_id', 'hidden', array('ng-model' => 'message.toContact_id'))
                ->add('toContact', 'text', array('class' => 'form-control'))
                ->add('subject', 'text', array('class' => 'form-control', 'ng-model' => 'message.subject'))
                ->add('MessagingDiscussions_id', 'hidden', array('ng-model' => 'reply.MessagingDiscussions_id', 'value' => $this->getValue('MessagingDiscussions_id', $values)))
                ->add('reply', 'textarea', array('class' => 'form-control', 'rows' => '8', 'value' => '', 'ng-model' => 'reply.message'))                
                ->add('uniqueId', 'hidden', array('value' => $this->getValue('uniqueId', $values), 'ng-model' => 'reply.uniqueId'))
                ->add('message', 'textarea', array('class' => 'form-control', 'rows' => '20', 'value' => '', 'ng-model' => 'message.message'))
                ->add('sendReply', 'button', array('class' => 'btn btn-primary btn-sm', 'value' => 'Send Email', 'ng-click' => 'sendReply(reply)'))
                ->add('sendMessage', 'button', array('class' => 'btn btn-primary btn-sm', 'value' => 'Send Email', 'ng-click' => 'sendMessage(message)'))
                ->add('discard', 'button', array('class' => 'btn btn-danger btn-sm', 'value' => 'Discard'));
                
        return $builder->getForm();
    }

}
