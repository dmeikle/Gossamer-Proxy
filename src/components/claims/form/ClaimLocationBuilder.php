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
 * Description of ClaimBuilder
 *
 * @author Dave Meikle
 */
class ClaimLocationBuilder extends AbstractBuilder{

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        $builder->add('unitNumber', 'text', array('ng-model' => 'model.unitNumber', 'class' => 'form-control', 'value' => $this->getValue('unitNumber', $values)))
                ->add('workAuthorizationReceived', 'text', array('ng-model' => 'model.workAuthorizationReceived', 'class' => 'form-control', 'value' => $this->getValue('workAuthorizationReceived', $values)))
                ->add('picturesTaken', 'text', array('ng-model' => 'model.picturesTaken', 'class' => 'form-control', 'value' => $this->getValue('picturesTaken', $values)))
                ->add('lockBoxNumber', 'text', array('ng-model' => 'model.lockBoxNumber', 'class' => 'form-control', 'value' => $this->getValue('lockBoxNumber', $values)))
                ->add('keysReceivedFrom', 'text', array('ng-model' => 'model.keysReceivedFrom', 'class' => 'form-control', 'value' => $this->getValue('keysReceivedFrom', $values)))
                ->add('id', 'hidden', array('value' => intval($this->getValue('id', $values))))
                ->add('Claims_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
        
        if(array_key_exists('projectAddressesFloorPlans', $options)) {
            $builder->add('ProjectAddressesFloorPlans_id', 'text', array('ng-model' => 'model.ProjectAddressesFloorPlans_id', 'class' => 'form-control', 'options' => $options['projectAddressesFloorPlans']));
        }  
        if(array_key_exists('currentClaimPhases', $options)) {
            $builder->add('CurrentClaimPhases_id', 'text', array('ng-model' => 'model.CurrentClaimPhases_id', 'class' => 'form-control', 'options' => $options['currentClaimPhases']));
        }  
        
        return $builder->getForm();
    }

}
