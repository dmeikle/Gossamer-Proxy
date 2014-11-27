<?php

namespace components\workperformed\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author davem
 */
class WorkPerformedBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('WorkPerformed', $validationResults)) {
            $builder->addValidationResults($validationResults['WorkPerformed']);
        }
     
        $builder->add('action', 'text', array('class' => 'form-control', 'value' => $this->buildValueArray($values['locales'], $options['locales'])), $values['locales'])
                ->add('code', 'text', array('class' => 'form-control', $this->getValue('code', $values)))   
                ->add('layer', 'select', array('class' => 'form-control', 'options' => ($values['layer'])))
                ->add('ClaimPhases_id', 'select', array('class' => 'form-control', 'options' => $options['ClaimPhases']))
                ->add('Departments_id', 'select', array('class' => 'form-control', 'options' => $options['Departments']))
                ->add('submit', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }


    private function buildValueArray(array $values, array $locales = null) {
        
        $retval = array();
        
        foreach($locales as $key => $row) {
            $retval[$key] = $values[$key]['action'];
        }
       
        return $retval;
    }
}
