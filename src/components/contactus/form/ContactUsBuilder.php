<?php

namespace components\contactus\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of ContactUsBuilder
 *
 * @author davem
 */
class ContactUsBuilder extends AbstractBuilder{
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('ContactUs', $validationResults)) {
            $builder->addValidationResults($validationResults['ContactUs']);
        }
       // pr($this->getValue('ContactUsTypes', $options));
        $builder->add('name','text',array('class' => 'form-control'))
                ->add('email','email',array('class' => 'form-control'))
                ->add('telephone','text',array('class' => 'form-control'))
                ->add('company','text',array('class' => 'form-control'))
                ->add('subject','text',array('class' => 'form-control'))
                ->add('comments','textarea',array('class' => 'form-control', 'rows' => '10', 'cols' => '40', 'value' => ''))
                ->add('ContactUsTypes_id', 'select',  array('class' => 'form-control', 'options' => $options['ContactUsTypes']))
                ->add('submit','submit',array('class' => 'btn btn-primary'));
                
                
        return $builder->getForm();
    }

//put your code here
}
