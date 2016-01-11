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

        $builder->add('unitNumber', 'text', array('ng-model' => 'location.unitNumber', 'class' => 'form-control'))
                ->add('firstname', 'text', array('ng-model' => 'location.firstname', 'class' => 'form-control'))
                ->add('lastname', 'text', array('ng-model' => 'location.lastname', 'class' => 'form-control'))
                ->add('buzzerCode', 'text', array('ng-model' => 'location.buzzerCode', 'class' => 'form-control'))
                ->add('existingDamage', 'textarea', array('rows' => '8', 'cols' => '40', 'ng-model' => 'location.existingDamage', 'class' => 'form-control', 'value' => ''))
                ->add('lockBoxNumber', 'text', array('ng-model' => 'location.lockBoxNumber', 'class' => 'form-control'))
                // ->add('workAuthorizationReceived', 'check', array('ng-model' => 'location.workAuthorizationReceived', 'Questions_id' => 'ClaimLocation_workAuthorizationReceived', 'required' => '', 'ng-init' => "location.workAuthorizationReceived = '" . $this->getValue('workAuthorizationReceived', $values) . "'"))
                // ->add('picturesTaken', 'check', array('ng-model' => 'location.picturesTaken', 'id' => 'ClaimLocation_picturesTaken', 'ng-init' => "location.picturesTaken = '" . $this->getValue('picturesTaken', $values) . "'"))
                ->add('keysReceivedFrom', 'text', array('ng-model' => 'location.keysReceivedFrom', 'class' => 'form-control'))
                ->add('daytimePhone', 'text', array('ng-model' => 'location.daytimePhone', 'class' => 'form-control'))
                ->add('mobile', 'text', array('ng-model' => 'location.mobile', 'class' => 'form-control'))
                ->add('claimLocationsAutocomplete', 'text', array('ng-model' => 'unit', 'ng-disabled' => '!claim.ProjectAddress', 'class' => 'form-control'))
                ->add('ClaimsLocations_id', 'hidden', array('value' => intval($this->getValue('ClaimsLocations_id', $values)), 'ng-model' => 'location.id'))
                ->add('Claims_id', 'hidden', array('value' => $this->getValue('Claims_id', $values), 'ng-model' => 'location.Claims_id'))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-primary'))
                ->add('specialInstructions', 'textarea', array('ng-model' => 'vm.location.specialInstructions', 'class' => 'form-control'))

                //For Affected Areas modal
                ->add('width', 'text', array('ng-model' => 'modal.item.width', 'class' => 'form-control'))
                ->add('height', 'text', array('ng-model' => 'modal.item.height', 'class' => 'form-control'))
                ->add('length', 'text', array('ng-model' => 'modal.item.length', 'class' => 'form-control'));

        if (array_key_exists('projectAddressesFloorPlans', $options)) {
            $builder->add('ProjectAddressesFloorPlans_id', 'text', array('ng-model' => 'location.ProjectAddressesFloorPlans_id', 'class' => 'form-control', 'options' => $options['projectAddressesFloorPlans']));
        }
        if (array_key_exists('currentClaimPhases', $options)) {
            $builder->add('CurrentClaimPhases_id', 'text', array('ng-model' => 'location.CurrentClaimPhases_id', 'class' => 'form-control', 'options' => $options['currentClaimPhases']));
        }
        if (array_key_exists('claimPhases', $options)) {
            $builder->add('ClaimPhases_id', 'select', array('ng-model' => 'location.ClaimPhases_id', 'class' => 'form-control', 'options' => $options['claimPhases']));
        }
        if (array_key_exists('claimStatus', $options)) {
            $builder->add('ClaimStatus_id', 'select', array('ng-model' => 'location.ClaimStatus_id', 'class' => 'form-control', 'options' => $options['claimStatus']));
        }
        if (array_key_exists('vehicles', $options)) {
            $builder->add('Vehicles_id', 'select', array('ng-model' => 'item.Vehicles_id', 'class' => 'form-control', 'options' => $options['vehicles']));
        }
        if (array_key_exists('areaTypes', $options)) {
            $builder->add('AreaTypes', 'select', array('ng-model' => 'modal.item.AreaTypes_id', 'class' => 'form-control', 'options' => $options['areaTypes']));
        }






        return $builder->getForm();
    }

}
