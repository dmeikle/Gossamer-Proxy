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
class ClaimBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        $builder->add('jobNumber', 'text', array('ng-model' => 'claim.jobNumber', 'class' => 'form-control', 'value' => $this->getValue('jobNumber', $values)))
                ->add('jobNumberHidden', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('jobNumber', $values)))
                ->add('callInDate', 'text', array('ng-model' => 'claim.callInDate', 'class' => 'form-control', 'value' => $this->getValue('callInDate', $values)))
                ->add('calledInBy', 'text', array('ng-model' => 'claim.calledInBy', 'class' => 'form-control', 'value' => $this->getValue('calledInBy', $values)))
                ->add('calledInPhone', 'text', array('ng-model' => 'claim.calledInPhone', 'class' => 'form-control', 'value' => $this->getValue('calledInPhone', $values)))
                ->add('timeCalledIn', 'text', array('ng-model' => 'claim.timeCalledIn', 'class' => 'form-control', 'value' => $this->getValue('timeCalledIn', $values)))
                ->add('deductable', 'text', array('ng-model' => 'claim.deductable', 'class' => 'form-control', 'value' => $this->getValue('deductable', $values)))
                ->add('policyNumber', 'text', array('ng-model' => 'claim.policyNumber', 'class' => 'form-control', 'value' => $this->getValue('policyNumber', $values)))
                ->add('asbestosTestRequired', 'text', array('ng-model' => 'claim.asbestosTestRequired', 'class' => 'form-control', 'value' => $this->getValue('asbestosTestRequired', $values)))
                ->add('enteredByStaffId', 'text', array('ng-model' => 'claim.enteredByStaffId', 'class' => 'form-control', 'value' => $this->getValue('enteredByStaffId', $values)))
                ->add('workAuthorizationReceiveDate', 'text', array('ng-model' => 'claim.workAuthorizationReceiveDate', 'uib-datepicker-popup' => '', "data-datepickername" => 'workAuthorizationReceiveDate',
                    'is-open' => 'datepicker.callIn', 'class' => 'form-control', 'value' => $this->getValue('workAuthorizationReceiveDate', $values)))
                ->add('ClaimTypes_other', 'text', array('ng-model' => 'claim.ClaimTypes_other', 'class' => 'form-control', 'value' => $this->getValue('ClaimTypes_other', $values)))
                ->add('dateReceived', 'text', array('ng-model' => 'claim.dateReceived', 'uib-datepicker-popup' => '', 'is-open' => 'datepicker.received', "data-datepickername" => 'dateReceived',
                    'class' => 'form-control', 'value' => $this->getValue('dateReceived', $values)))
                ->add('InsuranceCategories_id', 'text', array('ng-model' => 'claim.InsuranceCategories_id', 'class' => 'form-control', 'value' => $this->getValue('InsuranceCategories_id', $values)))
                ->add('ProjectAddresses_id', 'hidden', array('ng-model' => 'claim.ProjectAddresses_id', 'class' => 'form-control', 'value' => $this->getValue('ProjectAddresses_id', $values)))
                ->add('OnCallCallInstances_id', 'text', array('ng-model' => 'claim.OnCallCallInstances_id', 'class' => 'form-control', 'value' => $this->getValue('OnCallCallInstances_id', $values)))
                ->add('parentClaims_id', 'text', array('ng-model' => 'claim.parentClaims_id', 'class' => 'form-control', 'value' => $this->getValue('parentClaims_id', $values)))
                ->add('leadTechnicalStaff_id', 'text', array('ng-model' => 'claim.leadTechnicalStaff_id', 'class' => 'form-control', 'value' => $this->getValue('leadTechnicalStaff_id', $values)))
                ->add('projectManager_id', 'text', array('ng-model' => 'claim.projectManager_id', 'class' => 'form-control', 'value' => $this->getValue('projectManager_id', $values)))
                ->add('completionDate', 'text', array('ng-model' => 'claim.completionDate', 'uib-datepicker-popup' => '', 'is-open' => 'isOpen.completionDate', "data-datepickername" => 'completionDate',
                    'class' => 'form-control', 'value' => $this->getValue('completionDate', $values)))
                ->add('sourceUnitClaimsLocations_id', 'text', array('ng-model' => 'claim.sourceUnitClaimsLocations_id', 'class' => 'form-control', 'value' => $this->getValue('sourceUnitClaimsLocations_id', $values)))
                ->add('sourceOther', 'text', array('ng-model' => 'claim.sourceOther', 'class' => 'form-control', 'value' => $this->getValue('sourceOther', $values)))
                ->add('contactName', 'text', array('ng-model' => 'claim.contactName', 'class' => 'form-control', 'value' => $this->getValue('contactName', $values)))
                ->add('contactTelephone', 'text', array('ng-model' => 'claim.contactTelephone', 'class' => 'form-control', 'value' => $this->getValue('contactTelephone', $values)))
                ->add('reason', 'text', array('ng-model' => 'claim.reason', 'class' => 'form-control', 'value' => $this->getValue('reason', $values)))
                ->add('estimate', 'text', array('ng-model' => 'claim.estimate', 'class' => 'form-control', 'value' => $this->getValue('estimate', $values)))
                ->add('contentsNeeded', 'text', array('ng-model' => 'claim.contentsNeeded', 'class' => 'form-control', 'value' => $this->getValue('contentsNeeded', $values)))
                ->add('unassignedJobNumber', 'text', array('ng-model' => 'claim.unassignedJobNumber', 'class' => 'form-control', 'value' => $this->getValue('unassignedJobNumber', $values)))
                ->add('unassignedJobNumberHidden', 'hidden', array('value' => $this->getValue('unassignedJobNumber', $values)))
                ->add('id', 'hidden', array('value' => intval($this->getValue('id', $values))))
                ->add('Claims_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)))


                //->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));

        if (array_key_exists('claimTypes', $options)) {
            $builder->add('ClaimTypes_id', 'select', array('ng-model' => 'claim.ClaimTypes_id', 'class' => 'form-control', 'options' => $options['claimTypes']));
        }
        if (array_key_exists('claimPhases', $options)) {
            $builder->add('currentClaimPhases_id', 'select', array('ng-model' => 'claim.currentClaimPhases_id', 'class' => 'form-control', 'options' => $options['claimPhases']));
            $builder->add('ClaimPhases_id', 'select', array('ng-model' => 'claim.ClaimPhases_id', 'class' => 'form-control', 'options' => $options['claimPhases']));
        }
        if (array_key_exists('claimTypes', $options)) {
            $builder->add('currentClaimsStatusTypes_id', 'select', array('ng-model' => 'claim.currentClaimsStatusTypes_id', 'class' => 'form-control', 'options' => $options['claimTypes']));
        }
        return $builder->getForm();
    }

}
