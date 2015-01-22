<?php

namespace core\components\cms\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;


/**
 * Description of PageBuilder
 *
 * @author davem
 */
class PageBuilder extends AbstractBuilder {
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if(is_array($validationResults) && array_key_exists('CmsPage', $validationResults)) {
            $builder->addValidationResults($validationResults['CmsPage']);
        }
      
        echo 'value: ' .$this->getValue('name', $values);
       // pr($this->getValue('ContactUsTypes', $options));
        $builder->add('name','text',array('class' => 'form-control', 'id'=> 'page_name', 'placeholder' => 'page name', 'pattern' => '[a-zA-Z0-9\-\ _]{0,100}', 'value' => $this->getValue('name', $values)))
                ->add('CmsSections_id', 'select', array('class' => 'form-control', 'options' => $options['sections']))
                ->add('pageId','hidden',array('id' => 'pageId', 'value' => $this->getValue('id', $values)))
                ->add('permalink','text',array('class' => 'form-control', 'id' => 'permalink', 'value' => $this->getValue('permalink', $values)))
                ->add('isPublished','select',array('style' => 'display: none', 'value' => $this->getValue('isPublished', $values)))
                ->add('content','textarea',array( 'placeholder' => 'insert page content here', 'value' => $this->buildLocaleValuesArray('content', $values, $options['locales'])), $options['locales'])
                ->add('metaTitle','text',array( 'class' => 'form-control', 'value' => $this->buildLocaleValuesArray('metaTitle', $values, $options['locales'])), $options['locales'])
               
                ->add('submit','submit',array('class' => 'btn btn-primary'));
        
                
        return $builder->getForm();
    }

}
