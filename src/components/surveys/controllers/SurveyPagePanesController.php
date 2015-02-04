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
use components\surveys\form\SurveyPaneBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;


/**
 * Description of ScopingFormsController
 *
 * @author Dave Meikle
 */
class SurveyPagePanesController extends AbstractController{
    
    
    public function save($id) {
        $this->model->save($id);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_panes_list', array(0, 20));
    }
    
    public function edit($id) {
        $results = $this->model->edit($id);
        
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $results)));
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new SurveyPaneBuilder();
        
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
               
       
        $options = array(
                'locales' => $this->httpRequest->getAttribute('locales')
            );
        
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function listAllByPageId($id) {
        $result = $this->model->listAllByPageId($id);
        $list = array();
        if(count($result) > 0) {
            $list = current($result);
        }
      
        $surveyPanes = $this->httpRequest->getAttribute('SurveyPanes');
        $this->render(array('$SurveyPagePanes' => $list, 'SurveyPanes' => $surveyPanes));
        $this->render($result);
    }
    
    public function saveToPaneById($id) {
        $this->mode->saveToPaneById($id);
        
    }
}
