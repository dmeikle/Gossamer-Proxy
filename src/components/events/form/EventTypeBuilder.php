<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of EventTypeBuilder
 *
 * @author Dave Meikle
 */
class EventTypeBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('EventType', $validationResults)) {
            $builder->addValidationResults($validationResults['EventType']);
        }
        
        $builder->add('type', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('type', $values, $options['locales'])), $options['locales'])
                ->add('score', 'text', array('class' => 'form-control', 'value' => $this->getValue('score', $values)))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                
        
        return $builder->getForm();
    }

}
