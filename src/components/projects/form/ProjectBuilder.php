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

        $builder->add('buildingName', 'text', array('ng-model' => 'project.buildingName', 'class' => 'form-control', 'value' => $this->getValue('buildingName', $values)))
                ->add('address1', 'text', array('ng-model' => 'project.address1', 'class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('ng-model' => 'project.address2', 'class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('notes', 'textarea', array('ng-model' => 'project.notes', 'class' => 'form-control', 'value' => $this->getValue('notes', $values)))
                ->add('neighborhood', 'text', array('ng-model' => 'project.neighborhood', 'class' => 'form-control', 'value' => $this->getValue('neighborhood', $values)))
                ->add('numFloors', 'text', array('ng-model' => 'project.numFloors', 'class' => 'form-control', 'value' => $this->getValue('numFloors', $values)))
                ->add('numUnits', 'text', array('ng-model' => 'project.numUnits', 'class' => 'form-control', 'value' => $this->getValue('numUnits', $values)))
                ->add('numStrata', 'text', array('ng-model' => 'project.numStrata', 'class' => 'form-control', 'value' => $this->getValue('numStrata', $values)))
                ->add('city', 'text', array('ng-model' => 'project.city', 'class' => 'form-control', 'value' => $this->getValue('city', $values)))    
                ->add('postalCode', 'text', array('ng-model' => 'project.postalCode', 'class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('Provinces_id', 'select', array('ng-model' => 'project.Provinces_id', 'class' => 'form-control', 'options' => $options['provinces']))
                ->add('buildingAge', 'select', array('ng-model' => 'project.buildingAge', 'class' => 'form-control', 'options' => $this->getYears($options)))
                ->add('save', 'button', array('value' => 'Save', 'class' => 'btn btn-lg btn-primary'))
                ->add('cancel', 'button', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary'))
                ->add('propertyType', 'text', array('ng-model' => 'project.propertyType', 'class' => 'form-control', 'value' => $this->getValue('propertyType', $values)))
                ->add('buildingYear', 'text', array('ng-model' => 'project.buildingYear', 'class' => 'form-control', 'value' => $this->getValue('buildingYear', $values)))
                ->add('strata', 'text', array('ng-model' => 'project.strata', 'class' => 'form-control', 'value' => $this->getValue('strata', $values)))
                ->add('telephone', 'text', array('ng-model' => 'project.telephone', 'class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('management', 'text', array('ng-model' => 'project.management', 'class' => 'form-control', 'value' => $this->getValue('management', $values)))
                ->add('mainImage', 'text', array('ng-model' => 'project.mainImage', 'class' => 'form-control', 'value' => $this->getValue('mainImage', $values)))
                ->add('strataNumber', 'text', array('ng-model' => 'project.strataNumber', 'class' => 'form-control', 'value' => $this->getValue('strataNumber', $values)))
                ->add('googleMapLink', 'textarea', array('ng-model' => 'project.googleMapLink', 'class' => 'form-control', 'value' => $this->getValue('googleMapLink', $values)))
                ->add('googleMapImage', 'textarea', array('ng-model' => 'project.googleMapImage', 'class' => 'form-control', 'value' => $this->getValue('googleMapImage', $values)))
                ->add('projectAddressId', 'hidden', array('ng-model' => 'project.projectAddressId', 'value' => intval($this->getValue('id', $values))));
                
        
        return $builder->getForm();
    }
    
    private function getYears(array $options) {
        if(!array_key_exists('years', $options)) {
            $retval = '';
            for($i = date("Y"); $i > 1900; $i--) {
                $retval .= '<option value="' . $i . '">' . $i . '</option>';
            }
            $options['years'] = $retval;
        }
        
        return $options['years'];
    }

}
