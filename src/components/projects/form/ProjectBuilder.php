<?php

namespace components\projects\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;


/**
 * Description of ProjectBuilder
 *
 * @author davem
 */
class ProjectBuilder extends AbstractBuilder{
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Project', $validationResults)) {
            $builder->addValidationResults($validationResults['Project']);
        }              

        $builder->add('buildingName', 'text', array('class' => 'form-control', $this->getValue('buildingName', $values)))
                ->add('address1', 'text', array('class' => 'form-control', $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', $this->getValue('address2', $values)))
                ->add('notes', 'textarea', array('class' => 'form-control', $this->getValue('notes', $values)))
                ->add('city', 'text', array('class' => 'form-control', $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control', $this->getValue('postalCode', $values)))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('buildingAge', 'select', array('class' => 'form-control', 'options' => $options['years']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }

}
