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
              

        $builder->add('buildingName', 'text', array('class' => 'form-control', 'value' => $this->getValue('buildingName', $values)))
                ->add('address1', 'text', array('class' => 'form-control', 'value' => $this->getValue('address1', $values)))
                ->add('address2', 'text', array('class' => 'form-control', 'value' => $this->getValue('address2', $values)))
                ->add('strataNumber', 'text', array('class' => 'form-control', 'value' => $this->getValue('strataNumber', $values)))
                ->add('city', 'text', array('class' => 'form-control', 'value' => $this->getValue('CITY', $values)))
                ->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('postalCode', 'text', array('class' => 'form-control', 'value' => $this->getValue('postalCode', $values)))
                ->add('buildingAge', 'text', array('class' => 'form-control', 'value' => $this->getValue('buildingAge', $values)))
                ->add('notes', 'text', array('class' => 'form-control', 'value' => $this->getValue('notes', $values)))    
                ->add('mainImage', 'text', array('class' => 'form-control', $this->getValue('mainImage', $values)))
                ->add('previous', 'submit', array('value' => 'Previous', 'class' => 'btn btn-lg btn-primary')) 
                ->add('next', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary')) 
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-lg btn-primary')) 
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }

}
