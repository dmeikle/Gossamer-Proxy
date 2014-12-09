<?php

namespace components\surveys\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;



/**
 * Description of SurveyBuilder
 *
 * @author davem
 */
class MultipleChoiceQuestionBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
      
        if(is_array($validationResults) && array_key_exists('TextBoxQuestion', $validationResults)) {
            $builder->addValidationResults($validationResults['TextBoxQuestion']);
        }
       
        $builder->add('question', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('question', $values, $options['locales'])), $options['locales'])  
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': '')))
                ->add('QuestionTypes_id', 'select',  array('class' => 'form-control', 'options' => $options['questiontypes']))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'))
                ->add('submit', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }

}
