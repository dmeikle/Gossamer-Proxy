<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;


/**
 * Description of ProjectAddressBuilder
 *
 * @author Dave Meikle
 */
class ProjectAddressBuilder extends AbstractBuilder{
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
              

        $builder->add('buildingName', 'text', array('ng-model' => 'projectAddress.buildingName','class' => 'form-control', 'value' => $this->getValue('buildingName', $values)))
                ->add('address1', 'text', array('ng-model' => 'projectAddress.address1','class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('city', 'text', array('ng-model' => 'projectAddress.city','class' => 'form-control', 'value' => $this->getValue('city', $values)))
                ->add('neighborhood', 'text', array('ng-model' => 'projectAddress.neighborhood','class' => 'form-control', 'value' => $this->getValue('neighborhood', $values)))
                ->add('numFloors', 'text', array('ng-model' => 'projectAddress.numFloors','class' => 'form-control', 'value' => $this->getValue('numFloors', $values)))
                ->add('numUnits', 'text', array('ng-model' => 'projectAddress.numUnits','class' => 'form-control', 'value' => $this->getValue('numUnits', $values)))
                ->add('numStrata', 'text', array('ng-model' => 'projectAddress.numStrata','class' => 'form-control', 'value' => $this->getValue('numStrata', $values)))
                ->add('propertyType', 'text', array('ng-model' => 'projectAddress.propertyType','class' => 'form-control', 'value' => $this->getValue('propertyType', $values)))
                ->add('buildingYear', 'text', array('ng-model' => 'projectAddress.buildingYear','class' => 'form-control', 'value' => $this->getValue('buildingYear', $values)))
                ->add('strata', 'text', array('ng-model' => 'projectAddress.strata','class' => 'form-control', 'value' => $this->getValue('strata', $values)))
                ->add('telephone', 'text', array('ng-model' => 'projectAddress.telephone','class' => 'form-control', 'value' => $this->getValue('telephone', $values)))
                ->add('management', 'text', array('ng-model' => 'projectAddress.management','class' => 'form-control', 'value' => $this->getValue('management', $values)))
                ->add('postalCode', 'text', array('ng-model' => 'projectAddress.postalCode','class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('notes', 'text', array('ng-model' => 'projectAddress.notes','class' => 'form-control', 'value' => $this->getValue('notes', $values)))    
                ->add('mainImage', 'text', array('ng-model' => 'projectAddress.mainImage','class' => 'form-control', $this->getValue('mainImage', $values)))
                ->add('strataNumber', 'text', array('ng-model' => 'projectAddress.strataNumber','class' => 'form-control', 'value' => $this->getValue('strataNumber', $values)))
                ->add('googleMapLink', 'text', array('ng-model' => 'projectAddress.googleMapLink','class' => 'form-control', 'value' => $this->getValue('googleMapLink', $values)))
                ->add('googleMapImage', 'text', array('ng-model' => 'projectAddress.googleMapImage', 'class' => 'form-control', 'value' => $this->getValue('googleMapImage', $values)))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary')) 
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
        if(array_key_exists('provinces', $options)) {
            $builder->add('Provinces_id', 'select', array('ng-model' => 'projectAddress.Provinces_id','class' => 'form-control', 'options' => $options['provinces']));
        }       
        
        return $builder->getForm();
    }

}
