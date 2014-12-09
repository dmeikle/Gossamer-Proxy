<?php

namespace components\surveys\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;



/**
 * Description of SurveyBuilder
 *
 * @author davem
 */
class AnswerBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
        
        $builder->add('answer', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('answer', $values, $options['locales'])), $options['locales'])               
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': ''))) 
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }

}
