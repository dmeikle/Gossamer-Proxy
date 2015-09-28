<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of ContactBuilder
 *
 * @author Dave Meikle
 */
class ProspectBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('EventProspect', $validationResults)) {
            $builder->addValidationResults($validationResults['EventProspect']);
        }
        
        $builder->add('firstname', 'text', array('class' => 'form-control', 'value' => $this->getValue('firstname', $values)))
                ->add('lastname', 'text', array('class' => 'form-control', 'value' => $this->getValue('lastname', $values)))
                ->add('email', 'text', array('class' => 'form-control', 'value' => $this->getValue('email', $values)))
                ->add('company', 'text', array('class' => 'form-control', 'value' => $this->getValue('company', $values)))
                ->add('home', 'text', array('class' => 'form-control', 'value' => $this->getValue('home', $values)))
                ->add('mobile', 'text', array('class' => 'form-control', 'value' => $this->getValue('mobile', $values)))
                ->add('office', 'text', array('class' => 'form-control', 'value' => $this->getValue('office', $values)))
                ->add('extension', 'text', array('class' => 'form-control', 'value' => $this->getValue('extension', $values)))
                ->add('company', 'text', array('class' => 'form-control', 'value' => $this->getValue('company', $values)))
                ->add('prospectNotes', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('prospectNotes', $values)))
                ->add('respondedByStaff', 'text', array('class' => 'form-control', 'value' => $this->getValue('home', $values)))
                ->add('respondedToDate', 'text', array('readonly' => 'readonly', 'class' => 'form-control', 'value' => $this->getValue('respondedToDate', $values)))
                ->add('Events', 'text', array('class' => 'form-control', 'value' => $this->getValue('Events', $values)))
                ->add('staffNotes', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('staffNotes', $values)))
                ->add('merged', 'text', array('class' => 'form-control', 'value' => $this->getValue('merged', $values)))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                

        return $builder->getForm();
    }

}
