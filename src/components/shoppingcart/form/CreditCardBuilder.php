<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * ClientBuilder
 *
 * @author Dave Meikle
 */
class CreditCardBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('CreditCard', $validationResults)) {
            $builder->addValidationResults($validationResults['CreditCard']);
        }
              

        $builder->add('nameOnCard', 'text', array('class' => 'form-control', $this->getValue('nameOnCard', $values)))
                ->add('cardType', 'select', array('class' => 'form-control', 'options' => $this->getCardTypes()))
                ->add('number', 'text', array('class' => 'form-control'))
                ->add('expiryMonth', 'select', array('class' => 'form-control', $this->getMonths()))
                ->add('expiryYear', 'select', array('class' => 'form-control', $this->getYears()))
                ->add('verification', 'text', array('class' => 'form-control', 'maxlength' =>"4"));
                
        
        return $builder->getForm();
    }

    private function getCardTypes() {
        return "<option value=\"Visa\">Visa</option>\r\n<option value=\"MasterCard\">MasterCard</option>\r\n<option value=\"Amex\">American Express</option>\r\n";
    }
    
    private function getMonths() {
        return '<option value="0">select month</option>
            <option value="1">01</option> 
            <option value="2">02</option> 
            <option value="3">03</option> 
            <option value="4">04</option> 
            <option value="5">05</option> 
            <option value="6">06</option> 
            <option value="7">07</option> 
            <option value="8">08</option> 
            <option value="9">09</option> 
            <option value="10">10</option> 
            <option value="11">11</option> 
            <option value="12">12</option>';
    }
    
    private function getYears() {
        
        $retval = '';
        for($i = intval(date("Y")); $i < (intval(date("Y"))+10); $i++) {
            $retval .= "<option>$i</option>\r\n";
        }
        
        return $retval;
    }
}
