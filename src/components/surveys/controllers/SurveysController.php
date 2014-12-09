<?php


namespace components\surveys\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\surveys\form\SurveyBuilder;
use components\surveys\serialization\SurveysSerializer;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;


/**
 * Description of ScopingFormsController
 *
 * @author davem
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
}
