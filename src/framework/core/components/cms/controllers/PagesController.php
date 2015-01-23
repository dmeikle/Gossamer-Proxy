<?php

namespace core\components\cms\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\components\cms\form\PageBuilder;
use core\components\cms\serialization\SectionsSerializer;

class PagesController extends AbstractController
{
    public function search($id) {
        $result = $this->model->search($id);
        
        $this->render($result);
    }
    
    public function savePermalink() {
        $result = $this->model->savePermalink();
        
        $this->render($result);
    }
    
    public function preview($id) {
        $result = $this->model->preview($id);
        
        $this->render($result);
    }
    
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

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new PageBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
            
        $options = array();        
        $options['locales'] = $this->httpRequest->getAttribute('locales');
        
        $sections = $this->httpRequest->getAttribute('Sections');
        $sectionsSerializer = new SectionsSerializer();
        $sectionsList = $sectionsSerializer->formatSectionsOptionsList($sections, $values);
        pr($sectionsList);
        
        $options['sections'] = $sectionsList;
        unset($sectionsSerializer);
        
       
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
}
