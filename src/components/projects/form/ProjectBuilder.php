<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\projects\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;


/**
 * Description of ProjectBuilder
 *
 * @author Dave Meikle
 */
class ProjectBuilder extends AbstractBuilder{
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('ProjectAddress', $validationResults)) {
            $builder->addValidationResults($validationResults['ProjectAddress']);
        }              

        $builder->add('buildingName', 'text', array('class' => 'form-control', 'value' => $this->getValue('buildingName', $values)))
                ->add('address1', 'text', array('class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('notes', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('notes', $values)))
                ->add('neighborhood', 'text', array('class' => 'form-control', 'value' => $this->getValue('neighborhood', $values)))
                ->add('numFloors', 'text', array('class' => 'form-control', 'value' => $this->getValue('numFloors', $values)))
                ->add('numUnits', 'text', array('class' => 'form-control', 'value' => $this->getValue('numUnits', $values)))
                ->add('numStrata', 'text', array('class' => 'form-control', 'value' => $this->getValue('numStrata', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' => $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('buildingAge', 'select', array('class' => 'form-control', 'options' => $options['years']))
                ->add('save', 'button', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'button', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'))
                ->add('propertyType', 'text', array('class' => 'form-control', 'value' => $this->getValue('propertyType', $values)))
                ->add('buildingYear', 'text', array('class' => 'form-control', 'value' => $this->getValue('buildingYear', $values)))
                ->add('strata', 'text', array('class' => 'form-control', 'value' => $this->getValue('strata', $values)))
                ->add('telephone', 'text', array('class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('management', 'text', array('class' => 'form-control', 'value' => $this->getValue('management', $values)))
                ->add('mainImage', 'text', array('class' => 'form-control', 'value' => $this->getValue('mainImage', $values)))
                ->add('strataNumber', 'text', array('class' => 'form-control', 'value' => $this->getValue('strataNumber', $values)))
                ->add('googleMapLink', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('googleMapLink', $values)))
                ->add('googleMapImage', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('googleMapImage', $values)))
                ->add('projectAddressId', 'hidden', array('value' => intval($this->getValue('id', $values))));
                
        
        return $builder->getForm();
    }

}
