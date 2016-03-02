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
use Gossamer\CMS\Forms\Factory\ControlFactory;

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
                ->add('isPublished', 'select', array('style' => 'display: none', 'options' => $this->getPublishOptions($this->getValue('isPublished', $values))))
                ->add('content', 'textarea', array('placeholder' => 'insert page content here', 'value' => $this->buildLocaleValuesArray('content', $values, $options['locales'])), $options['locales'])
                ->add('metaTitle', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('metaTitle', $values, $options['locales'])), $options['locales'])
                ->add('lastModified', 'span', array('value' => $this->formatDate($this->getValue('lastModified', $values))))
                ->add('staffName', 'span', array('value' => $this->getValue('staffName', $values)))
                ->add('summary', 'textarea', array('class' => 'form-control', 'value' => $this->getValue('summary', $values)))
                ->add('submit', 'submit', array('class' => 'btn btn-primary', 'value' => 'Save'));
        if (array_key_exists('id', $values) && intval($values['id']) > 0) {
            $builder->add('update', 'button', array('class' => 'btn btn-xs btn-primary', 'value' => 'Update', 'id' => 'update_page'));
        } else {
            $builder->add('update', ControlFactory::PLACEHOLDER, array());
        }


        return $builder->getForm();
    }

    private function formatDate($dateAsString) {
        $date = new \DateTime($dateAsString);

        return date_format($date, 'l jS F Y \a\t g:ia');
    }

    private function getPublishOptions($isPublished) {
        pr($isPublished);
        $publishOptions = '<option value="1"';
        if ($isPublished == 1) {
            $publishOptions .= ' selected';
        }
        $publishOptions .= '>Publish</option><option value="0"';
        if ($isPublished == 0) {
            $publishOptions .= ' selected';
        }
        $publishOptions .= '>Offline</option>';

        return $publishOptions;
    }

}
