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
class SurveyBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Survey', $validationResults)) {
            $builder->addValidationResults($validationResults['Survey']);
        }
        
        $builder->add('name', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('name', $values, $options['locales'])), $options['locales'])
                ->add('description', 'textarea', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('description', $values, $options['locales'])), $options['locales'])
                ->add('permalink', 'text', array('class' => 'form-control', 'value' => $this->getValue('permalink', $values)))
                ->add('SurveyCategories_id', 'select',  array('class' => 'form-control', 'options' => $options['surveycategories']))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': ''))) 
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }

}
