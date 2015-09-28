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
class TextBoxQuestionBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('TextBoxQuestion', $validationResults)) {
            $builder->addValidationResults($validationResults['TextBoxQuestion']);
        }
        
        $builder->add('question', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('question', $values, $options['locales'])), $options['locales'])               
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': '')))
                ->add('QuestionTypes_id', 'select',  array('class' => 'form-control', 'options' => $options['questiontypes']))
                ->add('name', 'text',  array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('questionId', 'hidden',  array('value' => intval($this->getValue('id', $values))))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'))
                ->add('submit', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'));                
        
        //needed as placeholders for multichoice
            $builder->add('plusSign','placeholder', array())
                    ->add('searchBox', 'placeholder', array());
         
        return $builder->getForm();
    }

}
