<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\tickets\forms;


use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\Factory\ControlFactory;
/**
 * Description of TicketBuilder
 *
 * @author Dave Meikle
 */
class TicketBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }
        
        $options['TicketStatuses'] = '';
        
        $options['BlockingClaimsPhases'] = '';
        $options['TicketResolutions'] = '';
        
        $builder->add('creationDate', ControlFactory::SPAN, array('class' => 'form-control editable', 'value' => $this->getValue('creationDate', $values)))
                ->add('TicketCategories_id', 'select', array('class' => 'form-control', 'options' => $options['ticketcategories']))
                ->add('TicketTypes_id', 'select', array('class' => 'form-control', 'options' => $options['tickettypes']))
                ->add('TicketStatuses_id', 'select', array('class' => 'form-control', 'options' => $options['TicketStatuses']))
                ->add('TicketPriorities_id', 'select', array( 'class' => 'editable uneditable', 'options' => $options['ticketpriorities']))
                ->add('TicketResolutions_id', 'select', array('class' => 'form-control', 'options' => $options['TicketResolutions']))
                ->add('dueDate', 'text', array('class' => 'form-control datepicker editable', 'value' => $this->getValue('dueDate', $values)))
                //->add('parentId', 'label', array('class' => 'form-control', 'value' => $this->getValue('creationDate', $values)))
                ->add('labels', 'text', array('class' => 'form-control editable', 'value' => $this->getValue('labels', $values)))
                ->add('description', 'textarea', array('class' => 'form-control editable', 'value' => $this->getValue('description', $values)))
                ->add('id', ControlFactory::HIDDEN, array('value' => intval($this->getValue('id', $values))))
                ->add('Claims_id', ControlFactory::HIDDEN, array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)));
            $params = array(
                'class' => 'form-control', 'options' => $this->getClaimLocation($values)
            );
           
            if(intval($this->getValue('id')) > 0) {
                $params['readonly'] =  'true';
            }
            $builder->add('ClaimsLocations_id', ControlFactory::SELECT, $params)
                ->add('Staff_id', ControlFactory::HIDDEN, array('class' => 'form-control', 'value' => $this->getValue('Staff_id', $values)));
            $params = array(
                'class' => 'form-control', 'value' => $this->getJobNumber($values)
            );
            if(strlen($this->getJobNumber($values)) > 0) {
                $params['readonly'] =  'true';
            }
            $builder->add('jobNumber', ControlFactory::TEXTBOX, $params)                
                ->add('subject', ControlFactory::TEXTBOX, array('class' => 'editable textboxAsLabel', 'value' => $this->getValue('subject', $values)))
                ->add('Departments_id', ControlFactory::SELECT, array('class' => 'form-control', 'options' => $options['departments']))
                ->add('ClaimPhases_id', ControlFactory::SELECT, array('class' => 'form-control', 'options' => $options['claimphases']))
                ->add('blockingClaimsPhases_id', ControlFactory::SPAN, array('class' => 'form-control', 'options' => $this->getValue('BlockingClaimsPhases', $values)))
                ->add('labels', ControlFactory::TEXTBOX, array('class' => 'form-control', 'value' => $this->getValue('labels', $values)))
                ->add('assignedStaff', ControlFactory::TEXTBOX, array('class' => 'form-control', 'value' => $this->getStaffName($values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) ==1?  'true': ''))) 
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));                
        
        return $builder->getForm();
    }
    
    private function getStaffName(array $values = null) {
        if(is_null($values) || !array_key_exists('Staff', $values) || !array_key_exists('firstname', $values['Staff'])) {
            return '';
        }
        
        return $values['Staff']['firstname'] . ' ' . $values['Staff']['lastname'];
    }
    
    private function getJobNumber(array $values = null) {
        if(is_null($values) || !array_key_exists('Claim', $values) || !array_key_exists('jobNumber', $values['Claim'])) {
            return '';
        }
        
        return $values['Claim']['jobNumber'];
    }
    
    private function getClaimLocation(array $values = null) {
       //the ClaimsLocation key is a join made programmatically to obtain the
        //name of the unit number
        if(is_null($values) || !array_key_exists('ClaimsLocation', $values)) {
            return '';
        }
        if(!is_array($values['ClaimsLocation']) || !array_key_exists('unitNumber', $values['ClaimsLocation'])) {
            return '';
        }
        return '<option value="' . $values['ClaimsLocations_id'] . "'>" . $values['ClaimsLocation']['unitNumber'] . '</option>';
    }

}
