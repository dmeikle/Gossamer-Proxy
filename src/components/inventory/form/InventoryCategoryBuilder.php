<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\inventory\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * DepartmentBuilder
 *
 * @author Dave Meikle
 */
class InventoryCategoryBuilder extends AbstractBuilder{
    
     public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('Category', $validationResults)) {
            $builder->addValidationResults($validationResults['Category']);
        }
        $id = intval($this->getValue('id', $values));
        
        $builder->add('category', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('type', $values, $options['locales'])), $options['locales'])              
                ->add('typeId', 'hidden', array('class' => 'form-control', 'value' => $id))
                ->add('defaultLocale', 'hidden', array('class' => 'form-control', 'value' => $this->getDefaultLocale($options['locales'])))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                
        
        return $builder->getForm();
    }

    private function getDefaultLocale(array $locales) {
        foreach($locales as $locale) {
            if($locale['isDefault'] == 1) {
                return $locale['locale'];
            }
        }
        
        return '';
    }
}
