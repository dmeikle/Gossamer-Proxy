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
 * Description of FloorPlanBuilder
 *
 * @author Dave Meikle
 */
class FloorPlanBuilder extends AbstractBuilder{
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Project', $validationResults)) {
            $builder->addValidationResults($validationResults['Project']);
        }              

        $builder->add('name', 'text', array('class' => 'form-control', $this->getValue('name', $values)))
                ->add('floorPlan', 'file', array('class' => 'form-control'))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }

}
