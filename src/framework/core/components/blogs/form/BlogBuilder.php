<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\blogs\form;
        
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of BlogBuilder
 *
 * @author Dave Meikle
 */
class BlogBuilder extends AbstractBuilder{
    
    
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('EventContact', $validationResults)) {
            $builder->addValidationResults($validationResults['EventContact']);
        }
      
        $builder->add('subject', 'text', array('class' => 'form-control subject', 'value' => $this->buildLocaleValuesArray('subject', $values, $options['locales'])), $options['locales'])
                ->add('permalink', 'text', array('class' => 'form-control patterned', 'pattern' => '[a-zA-Z0-9\-\ _]{0,100}',  'value' => $this->buildLocaleValuesArray('permalink', $values, $options['locales'])), $options['locales'])
                ->add('comments', 'textarea', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('comments', $values, $options['locales'])), $options['locales'])
                ->add('tags', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('tags', $values, $options['locales'])), $options['locales'])
                ->add('BlogCategories_id', 'select', array('class' => 'form-control', 'options' => $options['BlogCategories']))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('isActive', $values)))
                ->add('isPublic', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('isPublic', $values)))
                ->add('isPublished', 'select', array('style' => 'display: none', 'options' => $this->getPublishOptions($this->getValue('isPublished', $values))))
                ->add('allowComments', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('allowComments', $values)))
                ->add('logo', 'text', array('class' => 'form-control', 'value' => $this->getValue('logo', $values))) 
                ->add('pageId', 'hidden', array( 'value' => $this->getValue('id', $values)))
                ->add('lastModified', 'span', array('value' => $this->formatDate($this->getValue('lastModified', $values))))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));                

        return $builder->getForm();
    }
    
    private function formatDate($dateAsString) {
        $date = new \DateTime($dateAsString);
        
        return date_format($date, 'l jS F Y \a\t g:ia');
    }

    private function getPublishOptions($isPublished) {
        $publishOptions = '<option value="1"';
        if($isPublished == 1) {
            $publishOptions .= ' selected';
        }
        $publishOptions .= '>Publish</option><option value="0"';
        if($isPublished == 0) {
            $publishOptions .= ' selected';
        }
        $publishOptions .= '>Offline</option>';
        
        return $publishOptions;
    }
}
