<?php

namespace components\incidents\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of SectionBuilder
 *
 * @author davem
 */
class IncidentTypeBuilder extends AbstractBuilder {
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('IncidentType', $validationResults)) {
            $builder->addValidationResults($validationResults['IncidentType']);
        }

        $builder->add('incidentType', 'text', array('class' => 'form-control','value' => $this->buildLocaleValuesArray('incidentType', $values, $options['locales'])), $options['locales'])
                ->add('score', 'select', array('class' => 'form-control', 'options' => $options['scores']))
                ->add('Sections_id', 'select', array('class' => 'form-control', 'multiple' => 'multiple', 'options' => (array_key_exists('Sections_id', $options) ? $options['Sections_id']: '')))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'))
                ->add('submit', 'submit', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }

    
}
