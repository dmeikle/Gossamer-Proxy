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
 * Description of ContactBuilder
 *
 * @author Dave Meikle
 */
class ContactBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('EventContact', $validationResults)) {
            $builder->addValidationResults($validationResults['EventContact']);
        }
        
        $builder->add('name', 'text', array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('email', 'text', array('class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('company', 'text', array('class' => 'form-control', 'value' => $this->getValue('company', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('isActive', $values)))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                

        return $builder->getForm();
    }

}
