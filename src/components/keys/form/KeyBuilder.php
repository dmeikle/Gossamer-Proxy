<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\keys\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * DepartmentBuilder
 *
 * @author Dave Meikle
 */
class KeyBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Key', $validationResults)) {
            $builder->addValidationResults($validationResults['Key']);
        }
        
        $builder->add('Claims_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)))
                ->add('ClaimsLocations_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)))
                ->add('receivedFrom', 'text', array('class' => 'form-control', 'value' => $this->getValue('receivedFrom', $values)))
                ->add('returnTo', 'text', array('class' => 'form-control', 'value' => $this->getValue('returnTo', $values)))
                ->add('KeyTypes_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('KeyTypes_id', $values)))
                ->add('description', 'text', array('class' => 'form-control', 'value' => $this->getValue('description', $values)))
                ->add('isActive', 'text', array('class' => 'form-control', 'value' => $this->getValue('isActive', $values)))
                ->add('isMissing', 'text', array('class' => 'form-control', 'value' => $this->getValue('isMissing', $values)))
                ->add('photo', 'text', array('class' => 'form-control', 'value' => $this->getValue('photo', $values)))
                ->add('returnDate', 'text', array('class' => 'form-control', 'value' => $this->getValue('returnDate', $values)));
                
        return $builder->getForm();
    }

}
