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
        
        if(is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
              

        $builder->add('claimNumber', 'text', array('class' => 'form-control', $this->getValue('claimNumber', $values)))
                ->add('Branches_id', 'text', array('class' => 'form-control', $this->getValue('Branches_id', $values)))
                ->add('initialPhaseID', 'text', array('class' => 'form-control', $this->getValue('initialPhaseID', $values)))
                ->add('estimatedRevenue', 'text', array('class' => 'form-control', $this->getValue('estimatedRevenue', $values)))
                ->add('startDate', 'text', array('class' => 'form-control', $this->getValue('startDate', $values)))
                ->add('anticipatedInvDate', 'email', array('class' => 'form-control', $this->getValue('anticipatedInvDate', $values)))
                ->add('matchBid', 'text', array('class' => 'form-control', $this->getValue('matchBid', $values)))
                ->add('bidAmount', 'text', array('class' => 'form-control', $this->getValue('bidAmount', $values)))
                ->add('sourceUnitClaimsLocations_id', 'text', array('class' => 'form-control', $this->getValue('sourceUnitClaimsLocations_id', $values)))    
                ->add('PropertyManagers_id', 'text', array('class' => 'form-control', $this->getValue('PropertyManagers_id', $values)))   
                ->add('InsuranceAdjusters_id', 'text', array('class' => 'form-control', $this->getValue('InsuranceAdjusters_id', $values)))   
                ->add('deductable', 'text', array('class' => 'form-control', $this->getValue('deductable', $values)))   
                ->add('policyNumber', 'text', array('class' => 'form-control', $this->getValue('policyNumber', $values)))   
                ->add('source', 'text', array('class' => 'form-control', $this->getValue('source', $values)))   
                ->add('buildingAge', 'text', array('class' => 'form-control', $this->getValue('buildingAge', $values)))   
                ->add('ClaimTypes_id', 'text', array('class' => 'form-control', $this->getValue('ClaimTypes_id', $values)))   
                ->add('ClaimTypes_other', 'text', array('class' => 'form-control', $this->getValue('ClaimTypes_other', $values)))   
                ->add('asbestosTest', 'text', array('class' => 'form-control', $this->getValue('asbestosTest', $values)))   
                ->add('fileNumber', 'text', array('class' => 'form-control', $this->getValue('fileNumber', $values)))   
                ->add('dateReceived', 'text', array('class' => 'form-control', $this->getValue('dateReceived', $values)))
                ->add('timeCalledIn', 'text', array('class' => 'form-control', $this->getValue('timeCalledIn', $values)))
                ->add('am', 'text', array('class' => 'form-control', $this->getValue('am', $values)))
                ->add('timeArrivedOnSite', 'text', array('class' => 'form-control', $this->getValue('timeArrivedOnSite', $values)))
                ->add('receivedByStaffId', 'text', array('class' => 'form-control', $this->getValue('receivedByStaffId', $values)))
                ->add('workAuthorizationReceiveDate', 'text', array('class' => 'form-control', $this->getValue('workAuthorizationReceiveDate', $values)))
                ->add('calledInBy', 'text', array('class' => 'form-control', $this->getValue('calledInBy', $values)))
                ->add('InsuranceCategories_id', 'text', array('class' => 'form-control', $this->getValue('InsuranceCategories_id', $values)))
                ->add('OnCallCallInstances_id', 'text', array('class' => 'form-control', $this->getValue('OnCallCallInstances_id', $values)))
                ->add('parentClaims_id', 'text', array('class' => 'form-control', $this->getValue('parentClaims_id', $values)))
                ->add('leadTechnicalStaff_id', 'text', array('class' => 'form-control', $this->getValue('leadTechnicalStaff_id', $values)))
                ->add('projectManager_id', 'text', array('class' => 'form-control', $this->getValue('projectManager_id', $values)))
                
                //->add('Provinces_id', 'select', array('class' => 'form-control', 'options' => $options['provinces']))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));
                
        
        return $builder->getForm();
    }

}
