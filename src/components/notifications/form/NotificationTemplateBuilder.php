<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\notifications\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * NotificationTemplateBuilder
 *
 * @author Dave Meikle
 */
class NotificationTemplateBuilder extends AbstractBuilder {
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('NotificationTemplate', $validationResults)) {
            $builder->addValidationResults($validationResults['NotificationTemplate']);
        }
        
        $builder->add('name', 'text', array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('description', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('description', $values)))
                ->add('template', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('template', $values)))
                ->add('name', 'text', array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('MessagingTypes_id', 'select', array('class' => 'form-control', 'options' => $options['messagingTypes']))
                ->add('save', 'submit', array('class' => 'btn btn-default', 'value' => 'Save'))
                ->add('cancel', 'cancel', array('class' => 'btn btn-default', 'value' => 'Cancel'));
                
        return $builder->getForm();
    }

}
