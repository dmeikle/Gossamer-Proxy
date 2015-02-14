<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\surveys\form\SurveyInputFormBuilder;
use components\surveys\form\SurveyBuilder;
use components\surveys\serialization\SurveysSerializer;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;


/**
 * Description of ScopingFormsController
 *
 * @author Dave Meikle
 */
class SurveysController extends AbstractController{
    
    
    public function save($id) {
        $this->model->save($id);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_list', array(0, 20));
    }
    
    public function edit($id) {
        $results = $this->model->edit($id);
        
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $results)));
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new SurveyBuilder();
        
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $categoriesList = $this->httpRequest->getAttribute('SurveyCategorys');      
              
        $serializer = new SurveysSerializer($this->logger);
        $selectedOptions = array($builder->getValue('SurveyCategorys_id', $values));
       
        $options = array('surveycategories' => $serializer->formatSelectionBoxOptions($categoriesList, $selectedOptions, 'category'));
        $options['locales'] = $this->httpRequest->getAttribute('locales');
        
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function getFullSurvey($permalink, $page) {
        $result = $this->model->getFullSurvey($permalink, $page);
       
        if(!array_key_exists('page', $result) && $page == 1) {
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect('admin_surveys_panes_not_found', array());
        }elseif (!array_key_exists('page', $result) ) {
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect('admin_surveys_completed', array());
        }
        
        $this->render(array('form' => $this->drawSurvey($this->model, $result), 'survey' => current($result['survey'])));        
    }
    
    protected function drawSurvey(FormBuilderInterface $model, array $values = null) {
      
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new SurveyInputFormBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        
        $options = array();
        $options['locales'] = $this->httpRequest->getAttribute('locales');
       
        $form = $builder->buildForm($formBuilder, $values, $options, $results);
                
        return $form;
    }
    
    public function saveFullSurvey($permalink, $page) {
        $this->model->saveFullSurvey($permalink, $page);
        $params = $this->httpRequest->getPost();
        
        if(array_key_exists('next', $params)) {
            $page = intval($page) + 1;
        } else {
            $page = intval($page) -1;
            if($page < 1) {
                $page = 1;
            }
        }
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_respond_by_permalink', array($permalink, $page));
    }
    
    public function listResponses($surveyId) {
        echo "this page needs more determination";
    }
}
