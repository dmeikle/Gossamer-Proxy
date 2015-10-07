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
class ClaimBuilder extends AbstractBuilder{

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        $builder->add('jobNumber', 'text', array('class' => 'form-control', 'value' => $this->getValue('jobNumber', $values)))
                ->add('callInDate', 'text', array('class' => 'form-control', 'value' => $this->getValue('callInDate', $values)))
                ->add('calledInBy', 'text', array('class' => 'form-control', 'value' => $this->getValue('calledInBy', $values)))
                ->add('calledInPhone', 'text', array('class' => 'form-control', 'value' => $this->getValue('calledInPhone', $values)))
                ->add('timeCalledIn', 'text', array('class' => 'form-control', 'value' => $this->getValue('timeCalledIn', $values)))
                ->add('deductable', 'text', array('class' => 'form-control', 'value' => $this->getValue('deductable', $values)))
                ->add('policyNumber', 'text', array('class' => 'form-control', 'value' => $this->getValue('policyNumber', $values)))
                ->add('asbestosTestRequired', 'text', array('class' => 'form-control', 'value' => $this->getValue('asbestosTestRequired', $values)))
                ->add('enteredByStaffId', 'text', array('class' => 'form-control', 'value' => $this->getValue('enteredByStaffId', $values)))
                ->add('workAuthorizationReceiveDate', 'text', array('class' => 'form-control', 'value' => $this->getValue('workAuthorizationReceiveDate', $values)))
                ->add('ClaimTypes_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('ClaimTypes_id', $values)))
                ->add('ClaimTypes_other', 'text', array('class' => 'form-control', 'value' => $this->getValue('ClaimTypes_other', $values)))
                ->add('dateReceived', 'text', array('class' => 'form-control', 'value' => $this->getValue('dateReceived', $values)))
                ->add('InsuranceCategories_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('InsuranceCategories_id', $values)))
                ->add('ProjectAddresses_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('ProjectAddresses_id', $values)))
                ->add('OnCallCallInstances_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('OnCallCallInstances_id', $values)))
                ->add('parentClaims_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('parentClaims_id', $values)))
                ->add('leadTechnicalStaff_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('leadTechnicalStaff_id', $values)))
                ->add('projectManager_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('projectManager_id', $values)))
                ->add('completionDate', 'text', array('class' => 'form-control', 'value' => $this->getValue('completionDate', $values)))
                ->add('sourceUnitClaimsLocations_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('sourceUnitClaimsLocations_id', $values)))
                ->add('sourceOther', 'text', array('class' => 'form-control', 'value' => $this->getValue('sourceOther', $values)))
                ->add('contactName', 'text', array('class' => 'form-control', 'value' => $this->getValue('contactName', $values)))
                ->add('contactTelephone', 'text', array('class' => 'form-control', 'value' => $this->getValue('contactTelephone', $values)))
                ->add('reason', 'text', array('class' => 'form-control', 'value' => $this->getValue('reason', $values)))
                ->add('estimate', 'text', array('class' => 'form-control', 'value' => $this->getValue('estimate', $values)))
                ->add('currentClaimPhases_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('currentClaimPhases_id', $values)))
                ->add('contentsNeeded', 'text', array('class' => 'form-control', 'value' => $this->getValue('contentsNeeded', $values)))
                ->add('currentClaimsStatusTypes_id', 'text', array('class' => 'form-control', 'value' => $this->getValue('currentClaimsStatusTypes_id', $values)))
                ->add('unassignedJobNumber', 'text', array('class' => 'form-control', 'value' => $this->getValue('unassignedJobNumber', $values)))
                ->add('id', 'hidden', array('value' => intval($this->getValue('id', $values))))
                ->add('Claims_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)))
                

                //->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));

        return $builder->getForm();
    }

}
