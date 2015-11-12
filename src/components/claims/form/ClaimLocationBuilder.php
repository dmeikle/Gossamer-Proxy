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
class ClaimLocationBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        $builder->add('unitNumber', 'text', array('ng-model' => 'item.unitNumber', 'class' => 'form-control'))
                ->add('firstname', 'text', array('ng-model' => 'item.firstname', 'class' => 'form-control'))
                ->add('lastname', 'text', array('ng-model' => 'item.lastname', 'class' => 'form-control'))
                ->add('buzzer', 'text', array('ng-model' => 'item.buzzer', 'class' => 'form-control', 'ng-init' => "item.buzzer = '" . $this->getValue('buzzer', $values) . "'"))
                ->add('daytimePhone', 'text', array('ng-model' => 'item.daytimePhone', 'class' => 'form-control'))
                ->add('mobile', 'text', array('ng-model' => 'item.mobile', 'class' => 'form-control'))
                ->add('ClaimPhases_id', 'select', array('ng-model' => 'item.ClaimPhases_id', 'class' => 'form-control', 'options' => $options['claimPhases']))
                ->add('ClaimStatus_id', 'select', array('ng-model' => 'item.ClaimStatus_id', 'class' => 'form-control', 'options' => $options['claimStatus']))
                ->add('id', 'hidden', array('value' => intval($this->getValue('id', $values)), 'ng-model' => 'item.id'))
                ->add('Claims_id', 'hidden', array('value' => $this->getValue('Claims_id', $values), 'ng-model' => 'item.Claims_id'))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-primary'));

        if (array_key_exists('projectAddressesFloorPlans', $options)) {
            $builder->add('ProjectAddressesFloorPlans_id', 'text', array('ng-model' => 'item.ProjectAddressesFloorPlans_id', 'class' => 'form-control', 'options' => $options['projectAddressesFloorPlans']));
        }
        if (array_key_exists('currentClaimPhases', $options)) {
            $builder->add('CurrentClaimPhases_id', 'text', array('ng-model' => 'item.CurrentClaimPhases_id', 'class' => 'form-control', 'options' => $options['currentClaimPhases']));
        }

        return $builder->getForm();
    }

}
