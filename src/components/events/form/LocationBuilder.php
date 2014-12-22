<?php

namespace components\events\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of LocationBuilder
 *
 * @author davem
 */
class LocationBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('EventLocation', $validationResults)) {
            $builder->addValidationResults($validationResults['EventLocation']);
        }
        
        $builder->add('name', 'text', array('class' => 'form-control', 'value' => $this->getValue('name', $values)))
                ->add('room', 'text', array('class' => 'form-control', 'value' => $this->getValue('room', $values)))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['Provinces']))
                ->add('address', 'text', array('class' => 'form-control', 'value' => $this->getValue('address', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' => $this->getValue('city', $values)))
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('mapUrl', 'text', array('class' => 'form-control', 'value' => $this->getValue('mapUrl', $values)))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                

        return $builder->getForm();
    }

}
