<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;



/**
 * Description of SurveyBuilder
 *
 * @author Dave Meikle
 */
class SurveyPaneBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Survey', $validationResults)) {
            $builder->addValidationResults($validationResults['Survey']);
        }
        
        $builder->add('title', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('title', $values, $options['locales'])), $options['locales'])
                ->add('name', 'text',  array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('cssClass', 'text',  array('class' => 'form-control', 'value' => $this->getValue('cssClass', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': ''))) 
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }

}
