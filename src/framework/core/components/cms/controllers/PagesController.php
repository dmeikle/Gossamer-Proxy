<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\components\cms\form\PageBuilder;
use core\components\cms\serialization\SectionsSerializer;

/**
 * controller for the cms pages
 * 
 * @author Dave Meikle
 */
class PagesController extends AbstractController {

    /**
     * search for a cms file based on keywords
     * 
     * @param string $id
     */
    public function search($id) {
        $result = $this->model->search($id);

        $this->render($result);
    }

    /**
     * update the permalink for an existing cms page
     */
    public function savePermalink() {
        $result = $this->model->savePermalink();

        $this->render($result);
    }

    /**
     * preview a page during edit
     * 
     * @param int $id
     */
    public function preview($id) {
        $result = $this->model->preview(intval($id));

        $this->render($result);
    }

    /**
     * view a page found by its permalink in the database
     * 
     * @param string $section1 based on url root/*
     * @param string $section2 based on url root/* /*
     * @param string $section3 based on url root/* /* /*
     */
    public function viewByPermalink($section1 = '', $section2 = '', $section3 = '') {
        $result = $this->model->viewByPermalink($section1, $section2, $section3);

        $this->render($result);
    }

    /**
     * edit - display an input form based on requested id
     * 
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result), 'page' => $result));
    }

    /**
     * draw the input form for the page
     * 
     * @param FormBuilderInterface $model
     * @param array $values
     * @return form
     */
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new PageBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();
        $options['locales'] = $this->httpRequest->getAttribute('locales');

        $sections = $this->httpRequest->getAttribute('CmsSections');
        $sectionsSerializer = new SectionsSerializer();
        $sectionsList = $sectionsSerializer->formatSectionsOptionsList($sections, $values);

        $options['sections'] = $sectionsList;
        unset($sectionsSerializer);
        
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

}
