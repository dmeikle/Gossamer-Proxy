<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Builds the user input for for the CMS admin
 *
 * @author Dave Meikle
 */
class PageBuilder extends AbstractBuilder {

    /**
     * 
     * @param FormBuilder $builder
     * @param array $values
     * @param array $options
     * @param array $validationResults
     * 
     * @return form
     */
    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('CmsPage', $validationResults)) {
            $builder->addValidationResults($validationResults['CmsPage']);
        }

        $builder->add('name', 'text', array('class' => 'form-control', 'id' => 'page_name', 'placeholder' => 'page name', 'pattern' => '[a-zA-Z0-9\-\ _]{0,100}', 'value' => $this->getValue('name', $values)))
                ->add('CmsSections_id', 'select', array('class' => 'form-control', 'options' => $options['sections']))
                ->add('pageId', 'hidden', array('id' => 'pageId', 'value' => $this->getValue('id', $values)))
                ->add('permalink', 'text', array('class' => 'form-control', 'id' => 'permalink', 'value' => $this->getValue('permalink', $values)))
                ->add('isPublished', 'select', array('style' => 'display: none', 'value' => $this->getValue('isPublished', $values)))
                ->add('content', 'textarea', array('placeholder' => 'insert page content here', 'value' => $this->buildLocaleValuesArray('content', $values, $options['locales'])), $options['locales'])
                ->add('metaTitle', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('metaTitle', $values, $options['locales'])), $options['locales'])
                ->add('submit', 'submit', array('class' => 'btn btn-primary'));


        return $builder->getForm();
    }

}
